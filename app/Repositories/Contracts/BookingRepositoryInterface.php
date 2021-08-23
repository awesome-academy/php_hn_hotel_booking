<?php
namespace App\Repositories\Contracts;

interface BookingRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get total revenue in current year
     * @param na
     * @return total revenue
     */
    public function getTotalRevenue();

    /**
     * statistic number of order per month in current year
     * @param na
     * @return order as month
     */
    public function statisticOrderPerMonth();

    /**
     * statistic revenue per month in current year
     * @param na
     * @return revenue as month
     */
    public function statisticRevenuePerMonth();
}
