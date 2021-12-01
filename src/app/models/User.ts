import { Profile } from "./Profile";

export class User {
    public username: string = '';
    public friends: Array<string> = [];
    public requests: Array<string> = [];
    public profil: Profile = new Profile("", "", "Neither nor", "", "oneLine")
}