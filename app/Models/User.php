<?php

namespace App\Models;

use Illuminate\Support\Collection;

class User
{
    /** @var string|null */
    private $subscriptionNumber;
    /** @var int */
    private $marketID;
    /** @var string|null */
    private $userID;
    /** @var string|null */
    private $firstName;
    /** @var string|null */
    private $lastName;
    /** @var string|null */
    private $zipCode;
    /** @var string|null */
    private $country;
    /** @var string|null */
    private $email;
    /** @var string|null */
    private $password;
    /** @var string|null */
    private $externalID;
    /** @var string|null */
    private $serviceID;
    /** @var bool */
    private $isValid;
    /** @var bool */
    private $isFound;
    /** @var bool */
    private $isTest;
    /** @var string|null */
    private $prefix;
    /** @var string|null */
    private $errorCode;
    /** @var Collection */
    private $magazines;
    /** @var Collection  */
    private $books;

    public function __construct()
    {
        $this->marketID = 0;
        $this->isValid = false;
        $this->isFound = false;
        $this->isTest = true;
        $this->magazines = new Collection();
        $this->books = new Collection();
    }

    /**
     * @return null|string
     */
    public function getSubscriptionNumber(): ?string
    {
        return $this->subscriptionNumber;
    }

    /**
     * @param null|string $subscriptionNumber
     * @return User
     */
    public function setSubscriptionNumber(?string $subscriptionNumber): User
    {
        $this->subscriptionNumber = $subscriptionNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getMarketID(): int
    {
        return $this->marketID;
    }

    /**
     * @param int $marketID
     * @return User
     */
    public function setMarketID(int $marketID): User
    {
        $this->marketID = $marketID;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUserID(): ?string
    {
        return $this->userID;
    }

    /**
     * @param null|string $userID
     * @return User
     */
    public function setUserID(?string $userID): User
    {
        $this->userID = $userID;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param null|string $firstName
     * @return User
     */
    public function setFirstName(?string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param null|string $lastName
     * @return User
     */
    public function setLastName(?string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param null|string $zipCode
     * @return User
     */
    public function setZipCode(?string $zipCode): User
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param null|string $country
     * @return User
     */
    public function setCountry(?string $country): User
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     * @return User
     */
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getExternalID(): ?string
    {
        return $this->externalID;
    }

    /**
     * @param null|string $externalID
     * @return User
     */
    public function setExternalID(?string $externalID): User
    {
        $this->externalID = $externalID;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getServiceID(): ?string
    {
        return $this->serviceID;
    }

    /**
     * @param null|string $serviceID
     * @return User
     */
    public function setServiceID(?string $serviceID): User
    {
        $this->serviceID = $serviceID;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     * @return User
     */
    public function setIsValid(bool $isValid): User
    {
        $this->isValid = $isValid;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFound(): bool
    {
        return $this->isFound;
    }

    /**
     * @param bool $isFound
     * @return User
     */
    public function setIsFound(bool $isFound): User
    {
        $this->isFound = $isFound;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTest(): bool
    {
        return $this->isTest;
    }

    /**
     * @param bool $isTest
     * @return User
     */
    public function setIsTest(bool $isTest): User
    {
        $this->isTest = $isTest;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param null|string $prefix
     * @return User
     */
    public function setPrefix(?string $prefix): User
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    /**
     * @param null|string $errorCode
     * @return User
     */
    public function setErrorCode(?string $errorCode): User
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getMagazines(): Collection
    {
        return $this->magazines;
    }

    /**
     * @param Collection $magazines
     * @return User
     */
    public function setMagazines(Collection $magazines): User
    {
        $this->magazines = $magazines;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    /**
     * @param Collection $books
     * @return User
     */
    public function setBooks(Collection $books): User
    {
        $this->books = $books;
        return $this;
    }

    public function fromObject(\stdClass $user): User
    {
        $this->subscriptionNumber = data_get($user, 'AgreementID') ?: null;
        $this->marketID = intval(data_get($user, 'MarketID', 0));
        $this->userID = data_get($user, 'UserID') ?: null;
        $this->firstName = data_get($user, 'FirstName') ?: null;
        $this->lastName = data_get($user, 'LastName') ?: null;
        $this->zipCode = data_get($user, 'PostalCode') ?: null;
        $this->country = data_get($user, 'CountryCode') ?: null;
        $this->email = data_get($user, 'Email') ?: null;
        $this->password = data_get($user, 'Password') ?: null;
        $this->externalID = data_get($user, 'ExternalID') ?: null;
        $this->serviceID = data_get($user, 'ServiceID') ?: null;
        $this->isValid = boolval(data_get($user, 'IsValid', false));
        $this->isFound = boolval(data_get($user, 'IsFound', false));
        $this->isTest = boolval(data_get($user, 'IsTest', false));
        $this->prefix = data_get($user, 'Prefix') ?: null;
        $this->errorCode = data_get($user, 'ErrorCode') ?: null;
        if (!empty($magazines = data_get($user, 'Magazines'))) {
            $this->magazines = (new Collection($magazines))->map(function (\stdClass $magazine) {
                return new Magazine($magazine);
            });
        }
        if (!empty($books = data_get($user, 'Books'))) {
            $this->books = collect($books)->map(function (\stdClass $book) {
                // Todo: Create a model for the books
                return $book;
            });
        }
        return $this;
    }
}
