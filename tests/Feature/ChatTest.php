<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Job;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_chat_page_and_send_messages(): void
    {
        // 1. Create a customer and a handyman
        $customer = User::factory()->create([
            'Role' => 'customer'
        ]);
        $handyman = User::factory()->create([
            'Role' => 'handyman'
        ]);

        // 2. Create a Job session between them
        $job = Job::create([
            'JobName' => 'AC Cleaning',
            'JobType' => 'HVAC',
            'JobDesk' => 'Need my AC serviced',
            'JobStatus' => 'pending',
            'CustomerID' => $customer->UserID,
            'HandymanID' => $handyman->UserID,
            'JobStartDate' => now()->format('Y-m-d H:i:s'),
        ]);

        // 3. Act as the customer
        $this->actingAs($customer);

        // 4. Access the messages page
        $response = $this->get(route('chat.index', ['job' => $job->JobID]));
        $response->assertStatus(200);
        $response->assertSee($handyman->name);
        $response->assertSee('HVAC');

        // 5. Send a chat message
        $messageText = 'Hello handyman, when will you arrive?';
        $sendResponse = $this->post(route('chat.send', $job->JobID), [
            'message' => $messageText,
        ]);

        // Assert redirect back to the chat room
        $sendResponse->assertRedirect(route('chat.index', ['job' => $job->JobID]));

        // Assert message stored in database
        $this->assertDatabaseHas('messages', [
            'JobID' => $job->JobID,
            'SenderID' => $customer->UserID,
            'message' => $messageText,
            'is_read' => false,
        ]);

        // 6. Poll for new messages (AJAX endpoint)
        $pollResponse = $this->getJson(route('chat.poll', $job->JobID) . '?after=0');
        $pollResponse->assertStatus(200);
        $pollResponse->assertJsonFragment([
            'message' => $messageText,
            'sender_name' => $customer->name,
            'is_mine' => true,
        ]);
    }
}
