<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status === 'unread') {
            $query->where('is_read', false);
        } elseif ($request->has('status') && $request->status === 'read') {
            $query->where('is_read', true);
        }

        $messages = $query->latest()->paginate(20);

        return view('admin.messages.index', compact('messages'));
    }

    public function show(Contact $message)
    {
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Contact $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé !');
    }
}