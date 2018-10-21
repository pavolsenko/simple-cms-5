<?php

use Illuminate\Database\Seeder;
use App\Tools\UrlTools;
use Faker\Factory as Faker;
use App\Blog\BlogPost\BlogPost;
use App\Blog\Comment\Comment;
use App\Blog\Comment\CommentAuthor;
use App\Blog\Author\Author;
use App\Blog\Author\SocialProfile;
use App\Blog\BlogCategory\BlogCategory;
use App\Blog\Page\Page;

class DatabaseSeeder extends Seeder
{

    // set up how many items you wanna seed
    // current data in all tables will be truncated before seeding

    const NUMBER_OF_AUTHORS = 10;
    const NUMBER_OF_CATEGORIES = 10;
    const NUMBER_OF_POSTS = 100;
    const NUMBER_OF_COMMENTS_AUTHORS = 200;
    const NUMBER_OF_COMMENTS = 1000;
    const NUMBER_OF_PAGES = 100;

    // these table will not be touched
    const IGNORED_TABLES = ['migrations', 'user', 'password_resets'];

    private $faker;
    private $blogPost;
    private $author;
    private $urlService;
    private $comment;
    private $commentAuthor;
    private $socialProfile;
    private $blogCategory;
    private $page;

    public function __construct(
        Faker $faker,
        BlogPost $blogPost,
        Author $author,
        UrlTools $urlService,
        Comment $comment,
        CommentAuthor $commentAuthor,
        SocialProfile $socialProfile,
        BlogCategory $blogCategory,
        Page $page
    ) {
        $this->faker = $faker;
        $this->blogPost = $blogPost;
        $this->author = $author;
        $this->urlService = $urlService;
        $this->comment = $comment;
        $this->commentAuthor = $commentAuthor;
        $this->socialProfile = $socialProfile;
        $this->blogCategory = $blogCategory;
        $this->page = $page;
    }

    public function run()
    {

        /* This will seed a complete DB of a blog with fake blog posts, authors, categories and comments */

        echo "\nSetting up stuff";

        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //$this->truncateTables();
        $this->faker = $this->faker->create();

        echo "\nSeeding blog authors (".self::NUMBER_OF_AUTHORS.") ";

        for ($ii = 0; $ii < self::NUMBER_OF_AUTHORS; $ii++) {
            $this->author = new Author();
            $this->author->user_id = 2;
            $this->author->first_name = $this->faker->firstName;
            $this->author->last_name = $this->faker->lastName;
            $this->author->title = $this->faker->sentence(3);
            $this->author->bio = $this->faker->paragraph(5);
            $this->author->website = $this->faker->url;
            $this->author->save();

            if (rand(0, 1)) {
                $this->socialProfile = new SocialProfile();
                $this->socialProfile->author_id = $this->author->id;
                $this->socialProfile->type = 'facebook';
                $this->socialProfile->name = $this->author->first_name.' '.$this->author->last_name;
                $this->socialProfile->handle = $this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->link = 'http://facebook.com/'.$this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->save();
            }

            if (rand(0, 1)) {
                $this->socialProfile = new SocialProfile();
                $this->socialProfile->author_id = $this->author->id;
                $this->socialProfile->type = 'twitter';
                $this->socialProfile->name = $this->author->first_name.' '.$this->author->last_name;
                $this->socialProfile->handle = '@'.$this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->link = 'http://twitter.com/'.$this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->save();
            }

            if (rand(0, 1)) {
                $this->socialProfile = new SocialProfile();
                $this->socialProfile->author_id = $this->author->id;
                $this->socialProfile->type = 'google_plus';
                $this->socialProfile->name = $this->author->first_name.' '.$this->author->last_name;
                $this->socialProfile->handle = $this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->link = 'http://plus.google.com/'.$this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->save();
            }

            echo '.';
        }

        echo "\nSeeding blog categories (".self::NUMBER_OF_CATEGORIES.') ';

        for ($ii = 0; $ii < self::NUMBER_OF_CATEGORIES; $ii++) {
            $this->blogCategory = new BlogCategory();
            $this->blogCategory->title = ucfirst($this->faker->word()).' '.$this->faker->word().' '.$this->faker->word();
            $this->blogCategory->description = $this->faker->paragraph(round(rand(10, 20)));
            $this->blogCategory->created_by = 2;
            $this->blogCategory->updated_by = $this->blogCategory->created_by;
            $this->blogCategory->enabled = 1;
            $this->blogCategory->url = $this->urlService->createUrlFromString($this->blogCategory->title);
            $this->blogCategory->color = $this->faker->hexColor();
            $this->blogCategory->save();
            echo '.';
        }

        echo "\nSeeding blog posts (".self::NUMBER_OF_POSTS.') ';

        for ($ii = 0; $ii < self::NUMBER_OF_POSTS; $ii++) {
            $this->blogPost = new BlogPost();
            $this->blogPost->title = $this->faker->sentence(10, true);
            $this->blogPost->intro_text = $this->faker->paragraph(round(rand(10,20)));
            for ($jj = 0; $jj < round(rand(3,10)); $jj++) {
                $this->blogPost->body_text .= '<div>'.$this->faker->paragraph(round(rand(10, 30))).'</div><br>';
            }
            $this->blogPost->author_id = round(rand(1, self::NUMBER_OF_AUTHORS));
            $this->blogPost->created_by = 2;
            $this->blogPost->updated_by = $this->blogPost->created_by;
            $this->blogPost->enabled = 1;
            $this->blogPost->url = $this->urlService->createUrlFromString($this->blogPost->title);
            $this->blogPost->save();
            $categories = [];
            for($jj = 0; $jj < 5; $jj++) {
                if (rand(0, 1)) {
                    array_push($categories, round(rand(1, self::NUMBER_OF_CATEGORIES)));
                }
            }
            $this->blogPost->categories()->attach($categories);
            echo '.';
        }

        echo "\nSeeding blog comment authors (".self::NUMBER_OF_COMMENTS_AUTHORS.') ';

        for ($ii = 0; $ii < self::NUMBER_OF_COMMENTS_AUTHORS; $ii++) {
            $this->commentAuthor = new CommentAuthor();
            $this->commentAuthor->name = $this->faker->name;
            $this->commentAuthor->email = $this->faker->email;
            $this->commentAuthor->website = $this->faker->url;
            $this->commentAuthor->ip_address = $this->faker->ipv4;
            $this->commentAuthor->save();
            echo '.';
        }

        echo "\nSeeding blog comments (".self::NUMBER_OF_COMMENTS.') ';

        for ($ii = 0; $ii < self::NUMBER_OF_COMMENTS; $ii++) {
            $this->comment = new Comment();
            $this->comment->blog_post_id = round(rand(1,self::NUMBER_OF_POSTS));
            $this->comment->comment_author_id = round(rand(1,self::NUMBER_OF_COMMENTS_AUTHORS));
            $this->comment->text = $this->faker->paragraph(round(rand(1,10)));
            $this->comment->status = 1;
            $this->comment->ip_address = $this->faker->ipv4;
            $this->comment->save();
            echo '.';
        }

        echo "\nSeeding static pages (".self::NUMBER_OF_PAGES.') ';

        for ($ii = 0; $ii < self::NUMBER_OF_PAGES; $ii++) {
            $this->page = new Page();
            $this->page->title = $this->faker->sentence(10, true);
            for ($jj = 0; $jj < round(rand(5,20)); $jj++) {
                $this->page->body_text .= '<div>'.$this->faker->paragraph(round(rand(10, 30))).'</div><br>';
            }
            $this->page->created_by = 2;
            $this->page->updated_by = $this->page->created_by;
            $this->page->enabled = 1;
            $this->page->url = $this->urlService->createUrlFromString($this->page->title);
            $this->page->save();
            echo '.';
        }

        echo "\nSetting up stuff";

        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "\nDone\n\n";
    }

    public function truncateTables() {
        $tables = DB::select('SHOW TABLES');
        $table_property = 'Tables_in_'.env('DB_DATABASE');
        foreach ($tables as $table) {
            if (!in_array($table->$table_property, self::IGNORED_TABLES)) {
                DB::table($table->$table_property)->truncate();
            }
        }
        return true;
    }

}
