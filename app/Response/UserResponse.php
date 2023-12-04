<?php

class UserResponse
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
