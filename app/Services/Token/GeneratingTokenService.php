<?php


namespace App\Services\Token;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Class GeneratingTokenService
 * @package App\Services\Token
 * @author Ahmed Helal Ahmed
 */
class GeneratingTokenService
{
    /**
     * @var User
     */
    private $users;
    /**
     * @var array
     */
    private $input;

    /**
     * @var array
     */
    private $output;

    /**
     * GeneratingTokenService constructor.
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function handle(array $input)
    {
        $this->input=$input;
        $this->setUser();
        if (!$this->output['user'] || !Hash::check($this->input['password'], $this->output['user']->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this
            ->setToken()
            ->setStatus()
            ->output;
    }

    /**
     * @return $this
     */
    private function setUser()
    {
        $this->output['user']=$this->users
            ->where('email', $this->input['email'])
            ->first();

        return $this;
    }

    /**
     * @return $this
     */
    private function setToken()
    {
        $this->output['token']=$this->output['user']
            ->createToken($this->input['device_name'])
            ->plainTextToken;

        return $this;
    }

    /**
     * @return GeneratingTokenService
     */
    private function setStatus(): GeneratingTokenService
    {
        $this->output['status']=true;
        return $this;
    }
}
