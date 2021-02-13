<?php


namespace App\Services\Github;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;

/**
 * Class SyncRepositoriesService
 * @package App\Services\Github
 * @author Ahmed Helal Ahmed
 */
class SyncRepositoriesService
{
    const GITHUB_URL = 'https://api.github.com/';
    const GITHUB_USERS_SLUG = 'users/';
    const GITHUB_USERS_REPOS = '/repos';
    private $output = [];
    private $input = [];

    /**
     * @param array $input
     * @return mixed
     */
    public function handle(array $input): array
    {
        $this->input = $input;
        return $this
            ->getRepositories()
            ->syncRepositories()
            ->setStatus()
            ->output;
    }

    /**
     * @return $this
     */
    public function setStatus(): SyncRepositoriesService
    {
        $this->output['status'] = true;
        return $this;
    }

    /**
     * @return $this
     */
    private function syncRepositories(): SyncRepositoriesService
    {
        $repos = collect($this->output['response']);
        $repos = $repos->map(function ($repo) {
            return [
                'slug' => $repo->name,
                'number_of_stars' => $repo->stargazers_count,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        });

        $this
            ->truncateRepositories()
            ->insertRepositories(
                $repos->toArray()
            );

        return $this;
    }

    /**
     * @param array $repos
     * @return $this
     */
    private function insertRepositories(array $repos): SyncRepositoriesService
    {
        DB::table('repositories')->insert($repos->toArray());

        return $this;
    }

    /**
     * @return $this
     */
    private function truncateRepositories(): SyncRepositoriesService
    {
        DB::table('repositories')->truncate();

        return $this;
    }

    /**
     * @return SyncRepositoriesService
     */
    private function getRepositories(): SyncRepositoriesService
    {
        $this->output['response'] = Curl::to(
            self::GITHUB_URL .
            self::GITHUB_USERS_SLUG .
            $this->input['name'] .
            self::GITHUB_USERS_REPOS
        )
            ->withHeader('user-agent: php')
            ->withContentType('application/json')
            ->asJsonResponse()
            ->get();
        return $this;
    }
}
