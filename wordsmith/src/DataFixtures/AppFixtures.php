<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) 
        {

            $article = new Article();
            $article->setTitle('Titre n° $i');
            $article->setAuthor(2);
            $article->setDateInserted(new \Datetime());
            $article->setContent('Article de fou n° $i');
            $article->setStatus(1);
            
            $manager->persist($article);
        }
        $manager->flush();
    }
}