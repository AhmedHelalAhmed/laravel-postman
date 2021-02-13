<?php


namespace App\Services\Github;

use App\Models\Repository;

/**
 * Class IndexingRepositoriesService
 * @package App\Services\Github
 * @author Ahmed Helal Ahmed
 */
class IndexingRepositoriesService
{
    /**
     * @var Repository
     */
    private $repositories;
    /**
     * @var array
     */
    private $output=[];

    /**
     * IndexingRepositoriesService constructor.
     * @param Repository $repositories
     */
    public function __construct(Repository $repositories)
    {
        $this->repositories = $repositories;
    }

    /**
     * @return array
     */
    public function handle(): array
    {

        return $this
            ->setRepositories()
            ->setCount()
            ->setStatus()
            ->output;
    }

    /**
     * @return IndexingRepositoriesService
     */
    private function setRepositories(): IndexingRepositoriesService
    {
        $this->output['repositories']=$this->repositories->get();
        return $this;
    }

    /**
     * @return IndexingRepositoriesService
     */
    private function setCount(): IndexingRepositoriesService
    {
        $this->output['repositories_count']=$this->output['repositories']->count();

        return $this;
    }

    /**
     * @return IndexingRepositoriesService
     */
    private function setStatus(): IndexingRepositoriesService
    {
        $this->output['status']=true;
        return $this;
    }
}
