@extends("layouts.dashboard")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Your API token</h2>
            </div>
            <div class="card-body">
                <p class="bg-gradient-lime p-2">{{ $token }}</p>
                <p>Use this key for your requests to our API.</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Table of Contents</h2>
            </div>
            <div class="card-body">
                <ul class="list-group-numbered">
                    <li>
                        <a href="#general_information">General information</a>
                        <ul class="list-group-numbered">
                            <li><a href="#url">URL</a></li>
                            <li><a href="#requests">Requests</a></li>
                            <li><a href="#responses">Responses</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Links</a>
                        <ul class="list-group-numbered">
                            <li><a href="#">Create short link</a></li>
                            <li><a href="#">List of links</a></li>
                            <li><a href="#">Delete short link</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Groups</a>
                        <ul class="list-group-numbered">
                            <li><a href="#">Create group</a></li>
                            <li><a href="#">List of groups</a></li>
                            <li><a href="#">Delete group</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card" id="general_information">
            <div class="card-header">
                <h2 class="card-title">General information</h2>
            </div>
            <div class="card-body">
                <p>Goo.su API allows you to create short links, create link groups, manage links and link groups, get
                    statistical information.</p>
            </div>
        </div>

        <div class="card" id="url">
            <div class="card-header">
                <h2 class="card-title">URL</h2>
            </div>
            <div class="card-body">
                <p>Our main API service is available here:</p>
                <p class="text-danger">{{ URL::to('/') }}/api</p>
            </div>
        </div>

        <div class="card" id="url">
            <div class="card-header">
                <h2 class="card-title">Links</h2>
            </div>
            <div class="card-body">
                <h3>Create short link</h3>
                <h4>Request example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
curl --request POST \
    --url https://goo.su/api/links/create \
    --header 'content-type: application/json' \
    --header 'x-goo-api-token: XXXXXX' \
    --data '{
        "url":"https://www.api.com",
        "alias":"cool",
        "is_public": true,
        "group_id":2
    }'
                    </pre>
                </div>
            </div>
        </div>
    </div>
@endsection
