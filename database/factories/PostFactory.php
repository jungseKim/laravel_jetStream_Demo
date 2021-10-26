<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    protected $users=null;
    protected $posts=null;
    public function __construct()
    {
        parent::__construct();
        $this->users=User::all();
        $this->posts=Post::all();
    }
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
            'content' => $this->faker->sentence(),
            'user_id'=>$this->users->random()->id ,
            // 'user_id'=>User::factory()->create()->id,
        ];
    }
}
