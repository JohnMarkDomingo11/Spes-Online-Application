<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Application;

class ApplicationStatusUpdated extends Notification
{
    use Queueable;

    public $application;
    public $status;
    public $admin;

    public function __construct(Application $application, string $status, $admin = null)
    {
        $this->application = $application;
        $this->status = $status;
        $this->admin = $admin;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'application_id' => $this->application->id,
            'application_name' => $this->application->full_name,
            'status' => $this->status,
            'admin' => $this->admin ? $this->admin->name : null,
            'message' => "Your application for {$this->application->full_name} has been {$this->status}.",
        ];
    }
}
