<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Models\User\Role;
use App\Models\User\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', User::class);
        $admins = User::where('user_type', 1)->simplePaginate(15);
        return view('admin.user.admin-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        $this->authorize('create', User::class);
        $inputs = $request->all();
        if ($inputs['activation'] == 1) {
            $inputs['activation_date'] = now();
        }

        if ($request->hasFile('avatar')) {

            $imageService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'avatars');
            $result = $imageService->save($request->file('avatar'));
            if ($result === false) {
                return redirect()->route('admin.user.admin-user.index')->with('alertify-error', 'آپلود آواتار با خطا مواجه شد.');
            }
            unset($inputs['avatar']);
            $inputs['profile_photo_path'] = $result;
        }

        $inputs['status'] = 1;
        $inputs['user_type'] = 1;
        $inputs['password'] = Hash::make($inputs['password']);
        User::create($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('alertify-success', 'ادمین جدید با موفقیت اضافه شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $this->authorize('update', User::class);
        return view('admin.user.admin-user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, User $admin, ImageService $imageService)
    {
        $this->authorize('update', User::class);
        $inputs = $request->all();

        if ($request->hasFile('avatar')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'avatars');
            $result = $imageService->save($request->file('avatar'));
            if ($result === false) {
                return redirect()->route('admin.user.admin-user.index')->with('alertify-error', 'آپلود آواتار با خطا مواجه شد.');
            }
            $imageService->deleteImage($admin->profile_photo_path);
            unset($inputs['avatar']);
            $inputs['profile_photo_path'] = $result;
        }


        $admin->update($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('alertify-warning', 'اطلاعات ادمین با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $this->authorize('delete', User::class);
        $admin->user_type = 0;
        $result = $admin->save();
        if (!$result) {
            return redirect()->route('admin.user.admin-user.index')->with('alertify-error', 'هنگام عملیات خطایی رخ داده است.');
        }

        RoleUser::where('user_id', $admin->id)->delete();
        return redirect()->route('admin.user.admin-user.index')->with('alertify-error', 'ادمین موردنظر با موفقیت از لیست حذف شد.');
    }

    public function status(User $admin)
    {
        $this->authorize('update', User::class);
        $admin->status = $admin->status == 0 ? 1 : 0;
        $result = $admin->save();

        if ($result) {
            if ($admin->status == 0)
                return response()->json(['status' => true, 'checked' => false]);
            else
                return response()->json(['status' => true, 'checked' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function activation(User $admin)
    {
        $this->authorize('update', User::class);
        $admin->activation = $admin->activation == 0 ? 1 : 0;
        $result = $admin->save();

        if ($result) {
            if ($admin->activation == 0)
                return response()->json(['status' => true, 'checked' => false]);
            else
                return response()->json(['status' => true, 'checked' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function roles(User $admin)
    {
        $this->authorize('index', Role::class);

        $roles = Role::all();
        $adminRolesIdArray = RoleUser::select('role_id')->where('user_id', $admin->id)->get()->pluck('role_id')->toArray();
        return view('admin.user.admin-user.roles', compact('roles', 'admin', 'adminRolesIdArray'));
    }

    public function setRole(Request $request, User $admin)
    {
        $this->authorize('create', Role::class);

        $request->validate([
            'role_id' => 'nullable|array|min:1',
            'role_id.*' => 'nullable|numeric|exists:roles,id'
        ]);


        if ($request->has('role_id')) {

            $inputs = $request->only('role_id');

            $admin->roles()->sync($inputs['role_id']);
        } else {
            $admin->roles()->sync([]);
        }
        return redirect()->route('admin.user.admin-user.index')->with('alertify-success', 'نقش های ادمین تغییر کرد.');
    }
}
