<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of all messages.
     */
    public function index()
    {
        $messages = Message::latest('created_at')->paginate(15);
        $unreadCount = Message::where('status', 'unread')->count();
        
        return view('themes.admin.messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display a specific message.
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        
        // Mark as read if unread
        if ($message->isUnread()) {
            $message->markAsRead();
        }
        
        return view('themes.admin.messages.show', compact('message'));
    }

    /**
     * Delete a message.
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        
        return admin_redirect('messages')->with('success', 'Message deleted successfully!');
    }

    /**
     * Mark message as replied.
     */
    public function markAsReplied($id)
    {
        $message = Message::findOrFail($id);
        $message->markAsReplied();
        
        return redirect()->back()->with('success', 'Message marked as replied!');
    }

    /**
     * Delete all read messages.
     */
    public function deleteRead()
    {
        $deleted = Message::where('status', '!=', 'unread')->delete();
        
        return admin_redirect('messages')->with('success', "$deleted read messages deleted!");
    }
}
