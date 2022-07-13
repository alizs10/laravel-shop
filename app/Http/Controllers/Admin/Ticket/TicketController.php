<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Ticket\Ticket;

class TicketController extends Controller
{

    public function index()
    {
        $this->authorize('index', Ticket::class);
        $page = "تمام تیکت ها";
        $tickets = Ticket::simplePaginate(15);
        return view('admin.ticket.index', compact('tickets', 'page'));
    }


    public function newTickets()
    {
        $this->authorize('index', Ticket::class);

        $page = "تیکت های جدید";
        $tickets = Ticket::where('seen', 0)->simplePaginate(15);
        return view('admin.ticket.index', compact('tickets', 'page'));
    }

    public function openedTickets()
    {
        $this->authorize('index', Ticket::class);

        $page = "تیکت های باز";
        $tickets = Ticket::where('status', 0)->simplePaginate(15);
        return view('admin.ticket.index', compact('tickets', 'page'));
    }

    public function closedTickets()
    {
        $this->authorize('index', Ticket::class);
        $page = "تیکت های بسته";
        $tickets = Ticket::where('status', 1)->simplePaginate(15);
        return view('admin.ticket.index', compact('tickets', 'page'));
    }



    public function show(Ticket $ticket)
    {
        $this->authorize('view', Ticket::class);
        if (!$ticket->seen) {
            $ticket->seen = 1;
            $result = $ticket->save();
            if (!$result) {
                return view('admin.ticket.show', compact('ticket'))->with('alertify-error', 'هنگام نمایش تیکت خطایی رخ داده است.');
            }
        }
        return view('admin.ticket.show', compact('ticket'));
    }



    public function answer(TicketRequest $request, Ticket $ticket)
    {
        $this->authorize('answer', Ticket::class);
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['seen'] = 1;
        $inputs['status'] = $ticket->status;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = 10;
        $inputs['cat_id'] = $ticket->cat_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        Ticket::create($inputs);
        return redirect()->route('admin.ticket.index')->with('alertify-success', 'پاسخ شما ارسال شد');
    }

    public function status(Ticket $ticket)
    {
        $this->authorize('update', Ticket::class);
        $id = $ticket->id;
        $relatedTickets = Ticket::where('ticket_id', $id)->get();
        if ($relatedTickets) {
            foreach ($relatedTickets as $relatedTicket) {

                $relatedTicket->status = $relatedTicket->status == 1 ? 0 : 1;
                $relatedTicket->save();
            }
        }

        $ticket->status = $ticket->status == 1 ? 0 : 1;
        $ticket->save();

        if ($ticket->status == 1) {
            return redirect()->back()->with('alertify-warning', 'تیکت موردنظر بسته شد.');
        } else {
            return redirect()->back()->with('alertify-success', 'تیکت موردنظر باز شد.');
        }
    }
}
