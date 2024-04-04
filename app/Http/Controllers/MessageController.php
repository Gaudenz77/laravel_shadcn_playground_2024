<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageCollection;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    // Show all messages
    public function index()
    {
        $messages = MessageCollection::all();
        return response()->json($messages);
    }

    // Show the form for creating a new message
    public function create()
    {
        return view('messages.create');
    }

    // Store a newly created message in storage
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ];

        // Create a validator instance
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in JSON format
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Validation passed, create message
        $message = new MessageCollection($request->all());
        $message->user_id = auth()->id(); // Assign the authenticated user's ID
        $message->save();

        // Return success message
        return response()->json(['message' => 'Message submitted successfully.'], 200);
    }


    // Update the specified message in storage
    public function update(Request $request, MessageCollection $message)
    {
        // Validation rules
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ];

        // Validate request data
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update message
        $message->update($request->all());

        // Fetch the updated message with the latest data
        $updatedMessage = MessageCollection::find($message->id);

        // Return the updated message data
        return response()->json($updatedMessage, 200);
    }


    // Remove the specified message from storage
    public function destroy(MessageCollection $message)
    {
        $message->delete();
        return response()->json(['message' => 'Message deleted successfully.'], 200);
    }
}
