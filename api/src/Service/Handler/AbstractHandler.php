<?php
namespace App\Service\Handler;

use App\Entity\AbstractEntity;
use App\Service\Command\AbstractCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractHandler
{
    protected EntityManager $em;

    protected ValidatorInterface $validator;

    public function __construct(EntityManager $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }
    
    abstract public function handle(AbstractCommand $command);

    /**
     * @return AbstractEntity|ConstraintViolationListInterface
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function post(AbstractEntity $entity, AbstractCommand $command)
    {
        $error = $this->validator->validate($command);
        if($error->count() == 0) {
            $data = $command->toArray();
            unset($data['_data']);
            $entity->setValues($data);
            $this->setStatusPhone($entity, $command);
            $this->em->persist($entity);
            $this->em->flush();

            return $entity;
        }

        return $error;
    }

    /**
     * @return object|ConstraintViolationListInterface|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function put(AbstractEntity $entityInput, AbstractCommand $command)
    {
        $entity = $this->em->getRepository(get_class($entityInput))->find($command->id);
        if(empty($entity)){
            throw new NotFoundHttpException("The record with ID: {$command->id} can't identified.");
        }

        $error = $this->validator->validate($command);
        if($error->count() == 0) {
            $entity->setValues($command->toArray());
            $this->setStatusPhone($entity, $command);
            $this->em->persist($entity);
            $this->em->flush();

            return $entity;
        }

        return $error;
    }

    /**
     * @return array|ConstraintViolationListInterface
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(AbstractEntity $entityInput, AbstractCommand $command)
    {
        $error = $this->validator->validate($command);
        if ($error->count() == 0) {
            $entity = $this->em->getRepository(get_class($entityInput))->find($command->id);
            if (empty($entity)) {
                throw new NotFoundHttpException("The record with ID: {$command->id} can't identified.");
            }

            $this->em->remove($entity);
            $this->em->flush();

            return [
                "The record with ID: {$command->id} was deleted."
            ];
        }

        return $error;
    }

    /**
     * @return object|ConstraintViolationListInterface|NULL
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function patch(AbstractEntity $entityInput, AbstractCommand $command)
    {
        return $this->put($entityInput, $command);
    }

    private function setStatusPhone(AbstractEntity $entityInput, AbstractCommand $command): void
    {
        $listIso = [
            'CM' => "/[2368]\d{7,8}$/",
            'ET' => "/[2368]\d{7,8}$/",
            'MA' => "/[5-9]\d{8}$/",
            'MZ' => "/[28]\d{7,8}$/",
            'UG' => "/d{9}$/",
        ];
        $listCode = [
            'CM' => '237',
            'ET' => '251',
            'MA' => '212',
            'MZ' => '258',
            'UG' => '256',
        ];
        $iso = trim($command->getValue('iso'));
        $pattern = $listIso[$iso];
        $entityInput->setValue('status', 'VALID');
        if(preg_match($pattern, $command->getValue('phone')) != 1) {
            $entityInput->setValue('status', 'INVALID');
        }

        if ($command->getValue('coutry') != $listCode[$iso]) {
            $entityInput->setValue('status', 'INVALID');
        }
    }
}
