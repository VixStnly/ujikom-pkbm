<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'parent_id' => $comment->id, // Set the parent_id to the ID of the comment being replied to
        ]);

        return redirect()->back();
    }
   public function destroy($id)
{
    try {
        // Find the comment or fail
        $comment = Comment::findOrFail($id);

        // Ensure only the comment owner can delete
        if (auth()->user()->id !== $comment->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Delete the comment
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully'], 200);
    } catch (ModelNotFoundException $e) {
        return response()->json(['message' => 'Comment not found'], 404);
    } catch (\Exception $e) {
        // Log the exception if needed
        \Log::error('Error deleting comment: ' . $e->getMessage());
        
        return response()->json(['message' => 'An error occurred while deleting the comment'], 500);
    }
}


}
