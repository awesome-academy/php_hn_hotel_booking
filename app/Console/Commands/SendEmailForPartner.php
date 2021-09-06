<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailJob;
use App\Mail\MailNotifyOrder;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailForPartner extends Command
{

    protected $userRepository;

    protected $bookingRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        BookingRepositoryInterface $bookingRepository
    ) {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $condition['where'][] = [
            'role', '=', config('user.partner'),
        ];
        $emailOfPartners = $this->userRepository->getAllWithCondition(['*'], $condition);
        foreach ($emailOfPartners as $partner) {
            $data = $this->bookingRepository->getInfoOrderWeekly($partner->id);
            dispatch(new SendEmailJob($data, $partner['email']));
        }
    }
}
