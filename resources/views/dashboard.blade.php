@php
    use App\Http\Enums\AccessLevels;

    $adminLevel = AccessLevels::ADMIN->access();
    $teamLeadLevel = AccessLevels::TEAM_LEAD->access();
    $userLevel = AccessLevels::USER->access();
@endphp

<x-app-layout>
    <div class="p-4 grid gap-6">
        <div id="currentUser" class="self-center bg-white py-5 px-10 rounded-lg z-20 drop-shadow-2xl">
            <h4>Name - {{$current_user["name"]}}</h4>
            <h7>Email - {{$current_user["email"]}}</h7>
            <p>Access Level - {{$current_user["access_level"]}}</p>
        </div>

        <div id="users" class="flex justify-center bg-white py-5 px-10 rounded-lg z-20 drop-shadow-2xl">
            <table class="table-auto w-2/4">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Access Level</th>
                    @if($current_user["access_level"] === AccessLevels::ADMIN->access())
                        <th></th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center">{{$user["name"]}}</td>
                        <td class="text-center">{{$user["email"]}}</td>
                        <td class="text-center">{{$user["access_level"]}}</td>
                        @if($current_user["access_level"] === $adminLevel)
                            <td><select name="access_level" class="access_level" data-source="{{$user["id"]}}">
                                    <option value="{{$adminLevel}}" @if ($adminLevel === $user["access_level"]) selected @endif>{{$adminLevel}}</option>
                                    <option value="{{$teamLeadLevel}}" @if ($teamLeadLevel === $user["access_level"]) selected @endif>{{$teamLeadLevel}}</option>
                                    <option value="{{$userLevel}}" @if ($userLevel === $user["access_level"]) selected @endif>{{$userLevel}}</option>
                                </select>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var accessLevelBtn = document.querySelectorAll('.access_level');

        for ($i = 0; $i < accessLevelBtn.length; $i++)
        {
            accessLevelBtn[$i].addEventListener('change', function () {
                var access_level = this.value;
                var user_id = this.getAttribute("data-source");
                axios.post("{{route("updateAccessLevel")}}", {
                    user_id: user_id,
                    access_level: access_level
                })
                    .then(function (response) {
                        if (response.data.status === "ok") {
                            location.reload();
                        }
                    })
            });
        }
    </script>
</x-app-layout>
