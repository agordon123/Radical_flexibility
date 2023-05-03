<?php
/**
 * User: Zura
 * Date: 9/17/2022
 * Time: 6:34 AM
 */

namespace App\Enums;

use StringBackedEnum;

/**
 * Class PaymentStatus
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package App\Enums
 */
final class PaymentStatus extends StringBackedEnum
{
    const Pending = 'pending';
    const Paid = 'paid';
    const Failed = 'failed';
}
