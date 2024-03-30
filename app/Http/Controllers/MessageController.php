<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageCollection;

class MessageController extends Controller
{
    // Show all messages
    public function index()
    {
        $messages = MessageCollection::all();
        return view('messages.index', compact('messages'));
    }

    // Show the form for creating a new message
    public function create()
    {
        return view('messages.create');
    }

    // Store a newly created message in storage
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'uploaded_files' => 'nullable|file',
        ]);

        MessageCollection::create($request->all());

        return redirect()->back()->with('success', 'Message submitted successfully.');
    }

    // Show the form for editing the specified message
    public function edit(MessageCollection $message)
    {
        return view('messages.edit', compact('message'));
    }

    // Update the specified message in storage
    public function update(Request $request, MessageCollection $message)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'uploaded_files' => 'nullable|file',
        ]);

        $message->update($request->all());

        return redirect()->back()->with('success', 'Message updated successfully.');
    }

    // Remove the specified message from storage
    public function destroy(MessageCollection $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
