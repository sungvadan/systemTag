<?php
namespace Vtp\TagBundle\Tests\Form\DataTransformer\TagsTransformer;




use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Repository\RepositoryFactory;
use PHPUnit\Framework\TestCase;
use Vtp\TagBundle\Entity\Tag;
use Vtp\TagBundle\Form\DataTransformer\TagsTransformer;

class  TagsTransformerTest extends TestCase {

    public function testCreateTagsArrayFromString(){
        $transformer = $this->getMockedTransformer();
        $tags = $transformer->reverseTransform("chat, chien");
        $this->assertCount(2,$tags);
        $this->assertSame('chien', $tags[1]->getName());
    }

    public function testUseAllreadyDefinedTag(){
        $tag = new Tag();
        $tag->setName('chat');
        $transformer = $this->getMockedTransformer([$tag]);
        $tags = $transformer->reverseTransform("chat, chien");
        $this->assertCount(2,$tags);
        $this->assertSame($tag, $tags[0]);
    }


    public function testRemoveEmptyTag(){
        $transformer = $this->getMockedTransformer([]);
        $tags = $transformer->reverseTransform("chat, ,chien,    , , , ");
        $this->assertCount(2,$tags);
        $this->assertSame('chien', $tags[1]->getName());
    }

    public function testUniqueTag(){
        $transformer = $this->getMockedTransformer([]);
        $tags = $transformer->reverseTransform("chat, ,chat ,    , , , ");
        $this->assertCount(1,$tags);
    }

    private function getMockedTransformer(array $result = [])
    {
        $tagRepository = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $tagRepository->expects($this->any())
            ->method('findBy')
            ->will($this->returnValue($result));

        $entityManager = $this->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($tagRepository));

        return new TagsTransformer($entityManager);
    }


}