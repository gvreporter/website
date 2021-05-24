<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use function App\Helpers\name_case_string;

const ALLOWED_HD = ['studenti.gobettivolta.edu.it', 'gobettivolta.edu.it'];

/**
 * Repository for all users
 *
 * Use this repository to interact with users in the DB
 *
*/
class UsersRepository {
    /**
     * Store a new user
     *
     * @param string $name The name of the user
     * @param string $username The username of the user
     * @param string $password The password for the user
     * @param null|string $role The role of the user
     * @param null|string $googleId The google account id of the user
     * @param null|string $profilePic The profile picture of the user
     *
     * @return \App\Models\User
    */
    public function store(string $name, string $username, string $password, ?string $role = 'user', ?string $googleId, ?string $profilePic): User
    {
        $user = new User;
        $user->name = $name;
        $user->username = $username;
        $user->password = (!$googleId) ? Hash::make($password) : 'GOOGLE-OAUTH';
        $user->role = $role;
        $user->google_id = $googleId;
        $user->profile_pic_url = $profilePic;
        $user->save();

        return $user;
    }

    /**
     * Get all the users
     *
     * @return \App\Models\User
    */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * Find a user by its id
     *
     * @param int $id
     *
     * @return \App\Models\User
    */
    public function find(int $id): ?User
    {
        return User::where('id', $id)->first();
    }

    /**
     * Update a user
     *
     * @param \App\Models\User $user
     * @param null|string $name
     * @param null|string $username
     * @param null|string $role
     * @param null|string $googleId
     * @param null|string $profilePic
     *
     * @return bool
    */
    public function update(User $user, ?string $name, ?string $username, ?string $role, ?string $googleId, ?string $profilePic): bool
    {
        $user->name = $name;
        $user->username = $username;
        $user->role = $role;
        $user->google_id = $googleId;
        $user->profile_pic_url = $profilePic;

        return $user->save();
    }

    /**
     * Delete a user
     *
     * @param int $id The user id
     *
     * @return bool
    */
    public function delete(int $id): bool
    {
        $user = $this->find($id);
        return $user->delete() ?? false;
    }

    /**
     * Fetch last (10) users registered
     *
     * @param int $count Defaults to 10
     *
     * @return \App\Models\User
    */
    public function last(int $count = 10) : Collection
    {
        return User::limit($count)->orderByDesc('created_at')->get();
    }

    /**
     * Get a user logged from Google OAuth
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Models\User
    */
    public function fromOAuth(Request $request): User
    {
        if(!$request->get('hd') || !in_array($request->get('hd'), ALLOWED_HD)) return abort(401);

        $guser = Socialite::driver('google')->user();

        $name = name_case_string($guser->getName());
        $username = $guser->getNickname() ?? Str::slug($name);

        $user = User::firstOrCreate([
            'profile_pic_url' => $guser->getAvatar(),
            'google_id' => $guser->getId(),
            'name' => $name,
            'username' => $username,
            'password' => 'GOOGLE-OAUTH', // Non hashed password to know that the user logged with a Google Account
            'role' => 'user',
        ]);

        return $user;
    }
}
