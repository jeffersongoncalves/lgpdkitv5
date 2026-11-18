<?php

namespace App\Models;

use JeffersonGoncalves\Filament\User\Models\User as BaseUser;
use JeffersonGoncalves\Lgpd\Attributes\PersonalData;
use JeffersonGoncalves\Lgpd\Concerns\InteractsWithPersonalData;
use JeffersonGoncalves\Lgpd\Contracts\HasPersonalData;
use JeffersonGoncalves\Lgpd\Enums\AnonymizeStrategy;
use JeffersonGoncalves\Lgpd\Enums\LegalBasis;

/**
 * Columns, casts, factory, observer, Filament panel access and avatar come from
 * jeffersongoncalves/laravel-user + jeffersongoncalves/filament-user.
 * Add traits, relations or overrides here.
 *
 * Personal data declared for Brazil's LGPD (Lei 13.709/2018): add a #[PersonalData] line for every column you add.
 */
#[PersonalData('name', purpose: 'Account identification', legalBasis: LegalBasis::Contract, anonymize: AnonymizeStrategy::Mask)]
#[PersonalData('email', purpose: 'Login and account notices', legalBasis: LegalBasis::Contract, anonymize: AnonymizeStrategy::Hash)]
class User extends BaseUser implements HasPersonalData
{
    use InteractsWithPersonalData;
}
