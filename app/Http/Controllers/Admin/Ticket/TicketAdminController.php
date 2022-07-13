<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{

    public function index()
    {   
        $this->authorize('index', TicketAdmin::class);
        $admins = TicketAdmin::simplePaginate(15);
        return view('admin.ticket.admin.index', compact('admins'));
    }


    public function all()
    {
        $this->authorize('create', TicketAdmin::class);
        $admins = User::where('user_type', 1)->simplePaginate(15);
        return view('admin.ticket.admin.all', compact('admins'));
    }

    public function set(User $admin)
    {
        $this->authorize('create', TicketAdmin::class);

        $id = $admin->id;
        $adminTicket = TicketAdmin::where('user_id', $id)->first();
        if ($adminTicket) {
            
            $result = TicketAdmin::destroy($adminTicket->id);
            if ($result) {
                return response()->json(['status' => true, 'set' => false]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            $result = TicketAdmin::create(['user_id' => $id]);
            if ($result) {
                return response()->json(['status' => true, 'set' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        }
    }


    public function destroy(TicketAdmin $admin)
    {
        $this->authorize('delete', TicketAdmin::class);

        $admin->delete();
        return redirect()->route('admin.ticket.admin.index')->with('alertify-error', 'ادمین موردنظر از لیست حذف شد.');
    }
}
