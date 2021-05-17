<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

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

    public function find(int $id): ?User
    {
        return User::where('id', $id)->first();
    }

    public function update(User $user, ?string $name, ?string $username, ?string $role, ?string $googleId, ?string $profilePic)
    {
        $user->update([
            'name' => $name,
            'username' => $username,
            'role' => $role,
            'google_id' => $googleId,
            'profile_pic_url' => $profilePic
        ]);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }
}
