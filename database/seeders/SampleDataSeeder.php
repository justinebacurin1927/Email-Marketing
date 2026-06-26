<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Tag;
use App\Models\MessageTemplate;
use App\Models\Campaign;
use App\Models\Label;
use App\Models\Source;
use App\Models\User;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $demoUser = User::where('email', 'demo@sendflow.test')->first();

        $tags = ['Newsletter', 'VIP', 'New Lead', 'Returning Customer', 'Test', 'Trial User', 'Premium'];
        foreach ($tags as $name) {
            Tag::firstOrCreate(['name' => $name]);
        }

        $labels = ['Important', 'Follow Up', 'Archive', 'Spam'];
        foreach ($labels as $name) {
            Label::firstOrCreate(['name' => $name]);
        }

        Source::firstOrCreate(['email' => 'marketing@example.com']);

        $contacts = [
            ['email' => 'alice@example.com', 'first_name' => 'Alice', 'last_name' => 'Johnson', 'company' => 'Tech Corp', 'subscribed' => true, 'city' => 'New York', 'country' => 'United States'],
            ['email' => 'bob@example.com', 'first_name' => 'Bob', 'last_name' => 'Smith', 'company' => 'Design Co', 'subscribed' => true, 'city' => 'San Francisco', 'country' => 'United States'],
            ['email' => 'carol@example.com', 'first_name' => 'Carol', 'last_name' => 'Williams', 'company' => 'Startup Inc', 'subscribed' => true, 'city' => 'Austin', 'country' => 'United States'],
            ['email' => 'dave@example.com', 'first_name' => 'Dave', 'last_name' => 'Brown', 'company' => 'Acme Ltd', 'subscribed' => false, 'city' => 'Chicago', 'country' => 'United States'],
            ['email' => 'eve@example.com', 'first_name' => 'Eve', 'last_name' => 'Davis', 'company' => 'Global Services', 'subscribed' => true, 'city' => 'Seattle', 'country' => 'United States'],
            ['email' => 'frank@example.com', 'first_name' => 'Frank', 'last_name' => 'Miller', 'company' => 'Miller & Sons', 'subscribed' => true, 'city' => 'Boston', 'country' => 'United States'],
            ['email' => 'grace@example.com', 'first_name' => 'Grace', 'last_name' => 'Lee', 'company' => 'Lee Innovations', 'subscribed' => true, 'city' => 'Denver', 'country' => 'United States'],
            ['email' => 'henry@example.com', 'first_name' => 'Henry', 'last_name' => 'Garcia', 'company' => 'Garcia Partners', 'subscribed' => true, 'city' => 'Miami', 'country' => 'United States'],
            ['email' => 'isla@example.com', 'first_name' => 'Isla', 'last_name' => 'Martinez', 'company' => 'Martinez Co', 'subscribed' => true, 'city' => 'Portland', 'country' => 'United States'],
            ['email' => 'jack@example.com', 'first_name' => 'Jack', 'last_name' => 'Wilson', 'company' => 'Wilson Consulting', 'subscribed' => true, 'city' => 'Atlanta', 'country' => 'United States'],
        ];

        $tagIds = Tag::pluck('id')->toArray();

        foreach ($contacts as $data) {
            $contact = Contact::firstOrCreate(['email' => $data['email']], $data);
            if ($contact->wasRecentlyCreated) {
                $contact->tags()->attach(array_rand(array_flip($tagIds), rand(1, 3)));
            }
        }

        $templateData = [
            ['name' => 'Welcome Email', 'subject' => 'Welcome to our community!', 'body' => '<h1>Welcome!</h1><p>Thank you for joining our email list. We\'re excited to have you on board!</p><p>Best regards,<br>The Team</p>'],
            ['name' => 'Monthly Newsletter', 'subject' => 'Your Monthly Update', 'body' => '<h1>Monthly Newsletter</h1><p>Here\'s what happened this month...</p><ul><li>New features</li><li>Updates</li><li>Upcoming events</li></ul>'],
            ['name' => 'Promotional Offer', 'subject' => 'Special Offer Just for You!', 'body' => '<h1>Special Offer</h1><p>Use code: SAMPLE20 for 20% off!</p><p><a href="#">Shop now</a></p>'],
            ['name' => 'Product Launch', 'subject' => 'Introducing Our New Product', 'body' => '<h1>Big News!</h1><p>We are thrilled to announce our latest product launch.</p><p>Be among the first to try it out.</p>'],
            ['name' => 'Re-engagement', 'subject' => 'We miss you!', 'body' => '<h1>Come back!</h1><p>It has been a while since we last heard from you. Here is a special offer to welcome you back.</p>'],
        ];

        foreach ($templateData as $data) {
            MessageTemplate::firstOrCreate(['name' => $data['name']], $data);
        }

        $contactIds = Contact::pluck('id')->toArray();
        $templateIds = MessageTemplate::pluck('id')->toArray();

        Campaign::updateOrCreate(
            ['name' => 'Welcome Campaign'],
            ['type' => 'regular', 'status' => 'sent', 'send_date' => now()->subDays(5)->format('Y-m-d'),
             'template_id' => $templateIds[0] ?? 1, 'sent_at' => now()->subDays(5),
             'created_by' => $demoUser?->name ?? 'Demo User']
        );

        $campaigns = [
            ['name' => 'March Newsletter', 'type' => 'regular', 'status' => 'draft',
             'template_id' => $templateIds[1] ?? 1, 'created_by' => $demoUser?->name ?? 'Demo User'],
            ['name' => 'Summer Sale', 'type' => 'regular', 'status' => 'scheduled',
             'send_date' => now()->addDays(7)->format('Y-m-d'),
             'template_id' => $templateIds[2] ?? 1, 'created_by' => $demoUser?->name ?? 'Demo User'],
            ['name' => 'Product Launch Q3', 'type' => 'regular', 'status' => 'draft',
             'template_id' => $templateIds[3] ?? 1, 'created_by' => $demoUser?->name ?? 'Demo User'],
            ['name' => 'Holiday Campaign', 'type' => 'regular', 'status' => 'scheduled',
             'send_date' => now()->addDays(14)->format('Y-m-d'),
             'template_id' => $templateIds[4] ?? 1, 'created_by' => $demoUser?->name ?? 'Demo User'],
        ];

        foreach ($campaigns as $data) {
            $camp = \App\Models\Campaign::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
            if ($camp->wasRecentlyCreated) {
                $camp->contacts()->sync([$contactIds[array_rand($contactIds)]]);
                if (!empty($tagIds)) {
                    $camp->tags()->sync([$tagIds[array_rand($tagIds)]]);
                }
            }
        }
    }
}
