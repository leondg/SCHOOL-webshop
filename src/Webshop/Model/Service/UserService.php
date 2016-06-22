<?php

namespace Webshop\Model\Service;

use Silex\Application;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Webshop\Model\Repository\AccountRepository;

class UserService implements UserProviderInterface
{
    const ROLE_USER = 'ROLE_USER';

    /**
     * @var Application
     */
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function loadUserByUsername($username)
    {
        $account = $this->getAccountRepository()->findByUsername($username);

        if ($account == null) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return new User($account->getUsername(), $account->getPassword(), [self::ROLE_USER], true, true, true, true);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }

    /**
     * @return AccountRepository
     */
    private function getAccountRepository()
    {
        return $this->app['repositories']['account'];
    }
}
