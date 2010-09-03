<?php

namespace Bundle\ForumBundle\Test\DAO;

use Bundle\ForumBundle\Test\WebTestCase;
use Bundle\ForumBundle\Entity\Category;
use Bundle\ForumBundle\Entity\Topic;

class TopicRepositoryTest extends WebTestCase
{
    public function testFindOneById()
    {
        $om = $this->getService('forum.object_manager');
        $repository = $om->getRepository('ForumBundle:Topic');

        $categoryClass = $this->categoryClass;
        $category = new $categoryClass();
        $category->setName('Topic repository test');
        $om->persist($category);

        $topicClass = $this->topicClass;
        $topic = new $topicClass($category);
        $topic->setSubject('Testing the ::findOneById method');
        $om->persist($topic);

        $om->flush();

        $foundTopic = $repository->findOneById($topic->getId());

        $this->assertNotEmpty($foundTopic, '::findOneById find a topic for the specified id');
        $this->assertInstanceOf($this->topicClass, $foundTopic, '::findOneById return a Topic instance');
        $this->assertEquals($topic, $foundTopic, '::findOneById find the right topic');
    }
}
