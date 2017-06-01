<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\Notification;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_see_all_of_his_notifications()
    {
        $this->signIn();

        /** @var User $user */
        $user = auth()->user();

        $user->notify(new TestNotification(111));
        $user->notify(new TestNotification(222));

        $this->assertCount(2, $user->notifications);
        $this->assertCount(2, $user->unreadNotifications);

        $user->notifications->markAsRead();

        tap($user->fresh(), function (User $user) {
            $this->assertCount(0, $user->unreadNotifications);
            $this->assertCount(2, $user->notifications);
        });

        $response = $this->get(route('dashboard.notifications.index'));

        $response->assertSeeText('Notification 111');
        $response->assertSeeText('Notification 222');
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        $this->signIn();

        /** @var User $user */
        $user = auth()->user();

        $user->notify(new TestNotification(111));
        $user->notify(new TestNotification(222));

        $this->assertCount(2, $user->unreadNotifications);

        $notification = $user->notifications()->first();

        $this->deleteJson(route('dashboard.notifications.destroy', $notification->id));

        tap($user->fresh(), function (User $user) {
            $this->assertCount(1, $user->unreadNotifications);
        });
    }

    /** @test */
    public function a_user_can_mark_all_notifications_as_read()
    {
        $this->signIn();

        /** @var User $user */
        $user = auth()->user();

        $user->notify(new TestNotification(111));
        $user->notify(new TestNotification(222));

        $this->assertCount(2, $user->unreadNotifications);

        $response = $this->get(route('dashboard.notifications.destroyAll'));

        tap($user->fresh(), function (User $user) {
            $this->assertCount(0, $user->unreadNotifications);
        });

        $response->assertRedirect();
    }

}

class TestNotification extends Notification
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'link' => '/',
            'message' => 'Test notification',
            'title' => "Notification {$this->message}",
            'small' => null,
        ];
    }
}

