<?php

namespace Konekt\AppShell\Tests\Feature;

use Konekt\AppShell\Tests\TestCase;

class UITestWithCustomAssetConfiguration extends TestCase
{
    /** @test */
    public function scripts_can_be_rendered_in_the_header_of_the_layout()
    {
        $url = config('konekt.app_shell.ui.url');

        $this->assertNotEmpty($url);
        $response = $this->actingAs($this->adminUser)->get(url($url));
        $response->assertStatus(200);

        $response->assertSeeInOrder(['</body>', asset('/headerscript.js'), '</head>']);
    }

    /** @test */
    public function css_can_be_rendered_in_the_footer_of_the_layout()
    {
        $url = config('konekt.app_shell.ui.url');

        $this->assertNotEmpty($url);
        $response = $this->actingAs($this->adminUser)->get(url($url));
        $response->assertStatus(200);

        $response->assertSeeInOrder(['</head>', asset('/footerstyle.css'), '</body>']);
    }

    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        $app['config']->set('konekt.app_shell.ui', [
            'name'   => 'AppShell',
            'url'    => '/admin/customer',
            'assets' => [
                'js' => [
                    '/headerscript.js' => [
                        '_location' => 'header'
                    ]
                ],
                'css' => [
                    '/footerstyle.css' => [
                        '_location' => 'footer'
                    ]
                ]
            ]
        ]);
    }
}
