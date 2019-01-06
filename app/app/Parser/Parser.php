<?php

namespace App\Parser;
use App\Parser\RepositoryInterface;
use App\Parcer\Options;

class Parser
{
    private $data;
    private $options;

    public function __construct(RepositoryInterface $repository, Options $options)
    {
        $this->data = $repository->getData();
        $this->options = $options;
    }

    public function start()
    {

    }


}