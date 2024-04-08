<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

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

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string',
            'leadtext' => 'required|string',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Create a new message instance
        $message = new MessageCollection([
            'title' => $request->title,
            'leadtext' => $request->leadtext,
            'message' => $request->message,
            'image' => null, // Default to null if no image is provided
        ]);
    
        // Check if an image file is uploaded
        if ($request->hasFile('image')) {
            // Store the uploaded image file in the specified directory
            $imagePath = $request->file('image')->store('images', 'public');
            // Assign the image path to the message
            $message->image = $imagePath;
        }
    
        // Assign the authenticated user's ID to the message
        $message->user_id = auth()->id();
        // Save the message
        $message->save();
    
        // Return a success response
        return response()->json(['message' => 'Message submitted successfully.'], 200);
    }
    


public function update(Request $request, MessageCollection $message)
    {
        // Validation rules
        $rules = [
            'title' => 'required|string',
            'leadtext' => 'required|string',
            'message' => 'required|string',
        ];
    
        // Validate request data manually
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Log validation errors
            Log::error('Validation errors:', $validator->errors()->all());
            
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

    /* public function showSingleStory(MessageCollection $message)
    {
        
        return response()->json($message);
    } */
    /* public function showSingleStory(MessageCollection $message)
    {
        return view('singlestory', ['message' => $message]);
    } */
    public function showSingleStory($id)
    {
        $message = MessageCollection::findOrFail($id);
        return Inertia::render('SingleStory', ['message' => $message]);
    }

}
