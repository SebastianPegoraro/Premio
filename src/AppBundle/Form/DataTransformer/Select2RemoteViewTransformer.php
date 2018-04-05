<?php
 
namespace AppBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class Select2RemoteViewTransformer implements DataTransformerInterface
{
    private $om;
    private $multiple;
    private $entityClass;

    public function __construct(ObjectManager $om, $entityClass, $multiple=false)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->multiple = $multiple;
    }

    /**
     *
     * @param  object $object
     * @return string
     */
    public function transform($value)
    {
        if (!$value) {
            return '';
        }

        return $value;
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $value
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            if ($this->multiple) {
                return array();
            }
            return null;
        }

        $qb = $this->om->getRepository($this->entityClass)
            ->createQueryBuilder('m');

        $qb->andWhere($qb->expr()->in('m.id', is_array($value) ? $value : array($value)));

        $result = $qb->getQuery()->getResult();

        if (count($result) === 0) {
            throw new TransformationFailedException();
        }

        return $this->multiple ? $result : $result[0];
    }
}