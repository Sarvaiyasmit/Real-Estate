<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactPageTest extends TestCase
{
    public function test_contact_page_shows_contact_actions_and_advisor_information(): void
    {
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Speak with a local advisor')
            ->assertSee('WhatsApp Concierge')
            ->assertSee('Request a private site visit')
            ->assertSee('href="tel:+919876543210"', false)
            ->assertSee('href="mailto:info@velorahomes.in"', false);
    }

    public function test_site_visit_action_opens_contact_form_with_site_visit_selected(): void
    {
        $this->get(route('contact', ['interest' => 'site_visit']).'#enquiry-form')
            ->assertOk()
            ->assertSee('id="enquiry-form"', false)
            ->assertSee('value="site_visit"', false);
    }
}
