<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use App\Http\Services\File\FileService;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use Illuminate\Support\Facades\Storage;

class EmailFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Email $email)
    {
        $this->authorize('index', EmailFile::class);
        return view('admin.notify.email-files.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email)
    {
        $this->authorize('create', EmailFile::class);

        return view('admin.notify.email-files.create', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
        $this->authorize('create', EmailFile::class);

        $inputs = $request->all();

        if ($request->hasFile('file')) {

            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            if (isset($inputs['file_name']) && $inputs['file_name'] !== '' && !empty($inputs['file_name'])) {
                $inputs['file_name'] = str_replace(' ', '-', $inputs['file_name']);
                $fileService->setFileName($inputs['file_name']);
            }

            if ($inputs['file_save_path'] == 1) {
                $result = $fileService->saveInStorage($request->file('file'));
            } else {
                $result = $fileService->saveInPublic($request->file('file'));
            }

            if ($result === false) {
                return redirect()->route('admin.notify.email-files.index', $email->id)->with('alertify-error', 'آپلود فایل با خطا مواجه شد');
            }
        }

        $inputs['file_path'] = $result;
        $inputs['file_name'] = $fileService->getFileName();
        $inputs['file_type'] = $fileService->getFileFormat();
        $inputs['file_size'] = $fileService->getFileSize();
        $inputs['public_mail_id'] = $email->id;


        EmailFile::create($inputs);
        return redirect()->route('admin.notify.email-files.index', $email->id)->with('alertify-success', 'فایل جدید با موفقیت آپلود شد');
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
    public function edit(EmailFile $file)
    {
        $this->authorize('edit', EmailFile::class);
        $emails = Email::all();
        return view('admin.notify.email-files.edit', compact('file', 'emails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailFileRequest $request, EmailFile $file, FileService $fileService)
    {
        $this->authorize('edit', EmailFile::class);
        $inputs = $request->all();

        if ($file->file_name !== $inputs['file_name']) {
            $inputs['file_name'] = str_replace(' ', '-', $inputs['file_name']);
            $newPath = $fileService->renameFile($file->file_path, $file->file_name, $inputs['file_name'], $file->file_save_path);
            $inputs['file_path'] = $newPath;
        }

        if ($inputs['file_save_path'] != $file->file_save_path) {

            if ($file->file_name !== $inputs['file_name']) {
                if ($inputs['file_save_path'] == 1) {
                    $fileService->moveFile($inputs['file_path'], 'public', 'private');
                } else {
                    $fileService->moveFile($inputs['file_path'], 'private', 'public');
                }
            } else {
                if ($inputs['file_save_path'] == 1) {
                    $fileService->moveFile($file->file_path, 'public', 'private');
                } else {
                    $fileService->moveFile($file->file_path, 'private', 'public');
                }
            }
        }



        $file->update($inputs);
        return redirect()->route('admin.notify.email-files.index', $file->public_mail_id)->with('alertify-warning', 'فایل با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailFile $file, FileService $fileService)
    {
        $this->authorize('delete', EmailFile::class);
        $result = $fileService->deleteFile($file->file_path, $file->file_save_path);
        if ($result) {
            $file->delete();
            return redirect()->route('admin.notify.email-files.index', $file->public_mail_id)->with('alertify-error', 'فایل با موفقیت حذف شد');
        } else {
            return redirect()->route('admin.notify.email-files.index', $file->public_mail_id)->with('alertify-error', 'عملیات با خطا مواجه شد');
        }
    }
}
