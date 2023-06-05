<?php

namespace Tests\Feature;

use App\Models\Dataset;
use Database\Seeders\DatasetSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class   DataTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test filtering datasets by category.
     *
     * @return void
     */

    public function testIndexListsDatasets()
    {
        $this->seed(DatasetSeeder::class);


        $response = $this->get('/');

        $response->assertSee('Test Category');
        $response->assertSee('John');
        $response->assertSee('Doe');
        $response->assertSee('johndoe@example.com');
        $response->assertSee('Male');
        $response->assertSee('1990-01-01');
    }

    /**
     * Test filtering datasets by category.
     *
     * @return void
     */
    public function testFilterByCategory()
    {
        $dataset = Dataset::factory()->create([
            'category' => 'Test Category',
            'gender' => 'Test Genre',
        ]);

        $response = $this->get('/', ['category' => 'Test Category', 'gender' => 'Test Genre']);

        $response->assertSee($dataset->category);
    }

    /**
     * Test pagination of datasets.
     *
     * @return void
     */

    public function testExportDataset()
    {
        $dataset = Dataset::factory()->create();

        $response = $this->get('/datasets/export');

        $response->assertOk();

        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');

        $response->assertHeader('Content-Disposition', 'attachment; filename="dataset.csv"');

        $this->assertStringContainsString($dataset->category, $response->getContent());
        $this->assertStringContainsString($dataset->firstname, $response->getContent());
        $this->assertStringContainsString($dataset->lastname, $response->getContent());
        $this->assertStringContainsString($dataset->email, $response->getContent());
        $this->assertStringContainsString($dataset->gender, $response->getContent());
        $this->assertStringContainsString($dataset->birthDate, $response->getContent());
    }

    /**
     * Test pagination of datasets.
     *
     * @return void
     */
    public function testPagination()
    {
        $datasets = Dataset::factory()->count(15)->make();

        $response = $this->get('/');

        $response->assertOk();

        $response->assertSeeInOrder($datasets->take(10)->pluck('name')->toArray());

        $response = $this->get('/?page=2');

        $response->assertOk();

        $response->assertSeeInOrder($datasets->skip(10)->pluck('name')->toArray());
    }

}
