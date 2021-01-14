<?php

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many tickets you need, defaulting to 10
        $count =10;

        $this->command->info("Creating {$count} tickets.");

        // Create the Ticket
        $tickets = factory(App\Ticket::class, $count)->create()->each(function($ticket) {
            $ticket->ticketTags()->save(factory(App\TicketTags::class)->make());
        });

        $this->command->info('Tickets Created!');
    }
}
