<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAiAgentAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guests cannot access the AI agent page.
     */
    public function test_guest_cannot_access_ai_agent_page(): void
    {
        $response = $this->get('/admin/ai/agent');
        $response->assertRedirect(route('login'));
    }

    /**
     * Regular users cannot access the AI agent page (403 Forbidden).
     */
    public function test_regular_user_is_forbidden_from_ai_agent_page(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'email' => 'client@portfolio.local',
        ]);

        $response = $this->actingAs($user)->get('/admin/ai/agent');
        $response->assertStatus(403);
    }

    /**
     * Secondary administrator without superadmin privileges is forbidden.
     */
    public function test_non_superadmin_admin_is_forbidden_from_ai_agent_page(): void
    {
        $secondaryAdmin = User::factory()->create([
            'role' => 'admin',
            'email' => 'editor@portfolio.local',
        ]);

        // Ensure this user does not qualify as superadmin
        if ($secondaryAdmin->id === 1) {
            $secondaryAdmin->id = 999;
            $secondaryAdmin->save();
        }

        $response = $this->actingAs($secondaryAdmin)->get('/admin/ai/agent');
        $response->assertStatus(403);
    }

    /**
     * Primary administrator (id=1 or email=admin@portfolio.local) can access the AI agent page.
     */
    public function test_primary_admin_can_access_ai_agent_page(): void
    {
        $admin = User::factory()->create([
            'id' => 1,
            'role' => 'admin',
            'email' => 'admin@portfolio.local',
        ]);

        $response = $this->actingAs($admin)->get('/admin/ai/agent');
        $response->assertStatus(200);
        $response->assertSee('AI Agents &amp; Skills Intelligence Center', false);
        $response->assertSee('Google Gemini / Antigravity');
        $response->assertSee('Anthropic Claude Code');
        $response->assertSee('Cursor IDE (MDC)');
    }

    /**
     * User with explicit role 'superadmin' can access the AI agent page.
     */
    public function test_superadmin_role_can_access_ai_agent_page(): void
    {
        $superadmin = User::factory()->create([
            'id' => 500,
            'role' => 'superadmin',
            'email' => 'super@portfolio.local',
        ]);

        $response = $this->actingAs($superadmin)->get('/admin/ai/agent');
        $response->assertStatus(200);
        $response->assertSee('AI Agents &amp; Skills', false);
    }

    /**
     * Superadmin can preview allowed rule file via POST /admin/ai/agent/preview.
     */
    public function test_superadmin_can_preview_allowed_file(): void
    {
        $superadmin = User::factory()->create([
            'role' => 'superadmin',
            'email' => 'super@portfolio.local',
        ]);

        $response = $this->actingAs($superadmin)->postJson('/admin/ai/agent/preview', [
            'path' => 'GEMINI.md',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['path', 'filename', 'content', 'size', 'last_modified']);
    }

    /**
     * User with email 'admin@portfolio.local' but ID != 1 and role 'admin' is NOT a superadmin.
     */
    public function test_email_alone_does_not_grant_superadmin_access(): void
    {
        $admin = User::factory()->create([
            'id' => 888,
            'role' => 'admin',
            'email' => 'admin@portfolio.local',
        ]);

        $response = $this->actingAs($admin)->get('/admin/ai/agent');
        $response->assertStatus(403);
    }

    /**
     * Ordinary admin cannot assign superadmin role on user creation.
     */
    public function test_ordinary_admin_cannot_create_superadmin_user(): void
    {
        $ordinaryAdmin = User::factory()->create([
            'id' => 200,
            'role' => 'admin',
            'email' => 'regularadmin@portfolio.local',
        ]);

        $response = $this->actingAs($ordinaryAdmin)->post('/admin/users', [
            'name' => 'Attempted Superadmin',
            'email' => 'attempt@portfolio.local',
            'password' => 'secret123',
            'role' => 'superadmin',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertDatabaseMissing('users', ['email' => 'attempt@portfolio.local']);
    }

    /**
     * Ordinary admin cannot elevate a user to superadmin on update.
     */
    public function test_ordinary_admin_cannot_elevate_user_to_superadmin(): void
    {
        $ordinaryAdmin = User::factory()->create([
            'id' => 201,
            'role' => 'admin',
            'email' => 'regularadmin2@portfolio.local',
        ]);

        $targetUser = User::factory()->create([
            'role' => 'user',
            'email' => 'target@portfolio.local',
        ]);

        $response = $this->actingAs($ordinaryAdmin)->put("/admin/users/{$targetUser->id}", [
            'name' => $targetUser->name,
            'email' => $targetUser->email,
            'role' => 'superadmin',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertEquals('user', $targetUser->fresh()->role);
    }

    /**
     * Superadmin can preview allowed rule file via GET /admin/ai/agent/preview.
     */
    public function test_superadmin_can_preview_allowed_file_via_get(): void
    {
        $superadmin = User::factory()->create([
            'role' => 'superadmin',
            'email' => 'super@portfolio.local',
        ]);

        $response = $this->actingAs($superadmin)->getJson('/admin/ai/agent/preview?path=GEMINI.md');

        $response->assertStatus(200);
        $response->assertJsonStructure(['path', 'filename', 'content', 'size', 'last_modified']);
    }

    /**
     * Unauthorized file traversal is blocked with 403.
     */
    public function test_unauthorized_file_preview_is_blocked(): void
    {
        $superadmin = User::factory()->create([
            'role' => 'superadmin',
            'email' => 'super@portfolio.local',
        ]);

        $response = $this->actingAs($superadmin)->postJson('/admin/ai/agent/preview', [
            'path' => '.env',
        ]);

        $response->assertStatus(403);
    }
}
