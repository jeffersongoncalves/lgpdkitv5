<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JeffersonGoncalves\Lgpd\Lgpd;
use Tests\TestCase;

class LgpdSuiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_user_personal_data_is_declared(): void
    {
        $columns = collect(app(Lgpd::class)->inventory())->where('model', User::class)->pluck('column')->all();

        $this->assertSame(['name', 'email'], $columns);
    }

    public function test_every_lgpd_page_opens_in_the_admin_panel(): void
    {
        $this->actingAs(Admin::factory()->create(), 'admin');
        $panel = Filament::getPanel('admin');
        $ours = fn (string $class): bool => str_starts_with($class, 'JeffersonGoncalves\\Filament\\Lgpd');

        $urls = collect($panel->getResources())->filter($ours)->map(fn (string $resource): string => $resource::getUrl('index', panel: 'admin'))
            ->merge(collect($panel->getPages())->filter($ours)->map(fn (string $page): string => $page::getUrl(panel: 'admin')));

        $this->assertGreaterThanOrEqual(11, $urls->count());

        foreach ($urls as $url) {
            $this->get($url)->assertOk();
        }

        $this->get('/admin')->assertOk()->assertSee('LGPD');
    }
}
