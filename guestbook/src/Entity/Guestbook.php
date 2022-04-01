<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampableTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Guestbook
 *
 * @ORM\Table(name="guestbook")
 * @ORM\Entity
 */
class Guestbook
{
    use TimestampableTrait;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="text", nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="text", nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", nullable=false)
     */
    private $email;

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $value)
    {
        $this->id = $value;
    }

    public function getFirstname() : string
    {
        return $this->firstname;
    }

    public function setFirstname(string $value)
    {
        $this->firstname = $value;
    }

    public function getLastname() : string
    {
        return $this->lastname;
    }

    public function setLastname(string $value)
    {
        $this->lastname = $value;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setContent(string $value)
    {
        $this->content = $value;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $value)
    {
        $this->email = $value;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {

        $metadata->addPropertyConstraint('content', new Assert\Length([
            'min' => 1,
            'max' => 150,
            'minMessage' => 'Your message must be at least {{ limit }} characters long',
            'maxMessage' => 'Your message cannot be longer than {{ limit }} characters',
        ]));

        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'The email "{{ value }}" is not a valid email.',
        ]));
    }
}
