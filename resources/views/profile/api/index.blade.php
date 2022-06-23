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


        <div class="card" id="requests">
            <div class="card-header">
                <h2 class="card-title">Requests</h2>
            </div>
            <div class="card-body">
                <p> You need to use in HTTP requests only HTTPS protocol and UTF-8 encoding. All requests require a header
                    <b> X-Goo-Api-Token.</b> </p>
            </div>
        </div>


        <div class="card" id="responses">
            <div class="card-header">
                <h2 class="card-title">Responses</h2>
            </div>
            <div class="card-body">
                <p>All responses are returned in JSON format and UTF-8 encoding.</p>
                <p>Possible response HTTP status codes:</p>
                <ul style="list-style: none">
                    <li><b>200 OK</b> The request was processed successfully</li>
                    <li><b>400 Bad Request.</b>The request contains invalid parameters.</li>
                    <li><b>401 Unauthorized.</b>Token is required for this request.</li>
                    <li><b>403 Forbidden</b>Not enough token rights for this request.</li>
                    <li><b>405 Method Not Allowed</b>status code indicates that the method received in the request-line is known by the origin server but not supported by the target resource.</li>
                    <li><b>404 Not Found</b>Unknown API Method.</li>
                    <li><b>500 Internal Server Error. </b>The error is related to technical problems on the server.</li>
                </ul>
            </div>

        </div>



        <div class="card" id="url">
            <div class="card-header">
                <h2 class="card-title">Links</h2>
            </div>
            <div class="card-body">
                <h3>Create short link</h3>
                <p class="text-danger">POST /links/create</p>
                <p>Service alows to create short link with any parameters</p>
                <h5>Required parameters:</h5>
                <p><b>alias </b><span class="text-danger"> String</span> URL to be shortened</p>
                <h5>Optional parameters:</h5>
                <p><b>alias </b><span class="text-danger"> String</span> This value will be displayed as an identifier. For example for "cool" alias, the short link will look like this - {{ URL::to('/') }}/cool. Max length 10 characters. By default, the alias will be randomly generated.</p>
                <p><b>is_public</b><span class="text-danger"> Boolean</span> By choosing the PUBLIC type, the link may be available to other Internet users. If you want the link to be private, set the value to Personal. By default value is TRUE</p>
                <p><b>password </b><span class="text-danger"> STRING</span> Set a password to protect your links from unauthorized access. By default this value is NULL.</p>
                <p><b>group_id</b><span class="text-danger"> INTEGER</span> The id of one of your groups. By setting the identifier, the created link will be available among other links within the group. By default this value is NULL.</p>
                <p><b>active_before</b><span class="text-danger"> DATE</span> Format 'Y-m-d'. The date until which the link will be available. After the expiration of the period, referrals to the link will be unavailable. If this parameter is not set, then the link will always be available. By default this value is NULL.</p>
                <h4>Request example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
curl --request POST \
    --url {{ URL::to('/') }}/api/links/create \
    --header 'content-type: application/json' \
    --header 'x-goo-api-token: XXXXXX' \
    --data '{
        "url":"https://www.api.com",
        "alias":"cool",
        "is_public": true,
        "group_id":2
    }

                    </pre>

                </div>
                <h4>Response example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
{
    "successful": true,
    "message": "Link successfully created",
    "link": {
        "long_url": "https://www.api.com",
        "short": "cool",
        "hits": 0,
        "group": {
            "id": 2,
            "name": "Test Group",
            "short": "wow",
            "description": "Description of the group",
            "url": "{{ URL::to('/') }}/g/wow"
        }
    },
    "short_url": "{{ URL::to('/') }}/cool",
    "qr": {
        "base64": "iVBORw0KGgoAAAANSUhEUgAAASwAAAEsAQAAAABRBrPYAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAd2KE6QAAAGPSURBVGje7ZpdroQgDIV5Y9m4ZHbQ64iUU/7u43TIIcag8+nE1LanxRB0RLnHvb+nqU4mg9hPYe+mh8NN3vs8m+R21fsTMTeYMSjaNFqgu7bOiXnG0D0TseOwnZ/mz03Knphz7GPxHFY2bc5eMEjQ84BP7FsYaiSc/CuluvxLzCc2FcDPEBwZYng054l5wMbKJYFr69ZhqQTzEs+J+cbUrCOWalJuyVexOiHmBHt9E3UR2vdhmqdrRs7EXGO91h0x24kq+qo5clVcxLxgM6WUsjk0TSfQUULMHzZvNYzaWKtUeCX69yQT84Whb2JAbidrtdvqX8zIp2DXEU/6GtE2jlaYpuYErwf+BTEXWJdJMcOCodXuqr7ENhILQMwVtlx+tR0M49GqvoSYF2xUQTulFALWubt+IzFP2NymNjuLzKukA7DriCc1a22y7fDHxTcw4/rdz2LXcU+6D7lGMolZyyPmF9OSZ4Nh5avrO6t0TMwHNmkPxl5uaZRO2awCEPs+NkTjDpuvsIfWmBJivrA/OACaB5gWD2cAAAAASUVORK5CYII="
    }
}

                    </pre>
                </div>
                <h4>Response fields:</h4>
                <p><b>successful <span class="text-danger">Boolean </span></b> Successful request</p>
                <p><b>message <span class="text-danger"> String </span></b> Text message. By default is NULL
                </p>
                <p><b>link.long_url <span class="text-danger"> String </span></b> Source url</p>
                <p><b>link.short <span class="text-danger"> String </span></b> Alias of the short link</p>
                <p><b>link.hits <span class="text-danger">Integer </span></b>  Number of clicks on the link</p>
                <p><b>link.group.id <span class="text-danger">Integer </span></b> Id of the link group</p>
                <p><b>link.group.name <span class="text-danger"> String </span></b> Name of the link group</p>
                <p><b>link.group.description <span class="text-danger"> String </span></b> Description of the link group</p>
                <p><b>link.group.url <span class="text-danger"> String </span></b> Url of the link group</p>
                <p><b>short_url <span class="text-danger"> String </span></b> Short link</p>
                <p><b>qr.base64 <span class="text-danger"> String </span></b> Image of the QR code of the link in base64 format</p>
                <h4>List of links</h4>
                <p class="text-danger">GET /links</p>
                <p>Goo.su Api alows to get list of your links.</p>
                <h5>Optional parameters:</h5>
                <p><b>limit <span class="text-danger">Integer </span></b> The number of links contained in the result. Max value is 25. By default is 25.</p>
                <p><b>offset <span class="text-danger">Integer </span></b> The number of items to skip. By default is 0.</p>
                <p><b>group_id <span class="text-danger">Integer </span></b> Id of one of your groups. The result will include links for this group. By default NULL.</p>
                <h4>Request example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
curl --header 'X-Goo-Api-Token: XXXXXXX' '{{ URL::to('/') }}/api/links?limit=2&offset=3&group_id=2'</pre>
                </div>
                <h4>Response example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
{
    "successful": true,
    "message": "",
    "count": 6,
    "limit": 2,
    "offset": 3,
    "links": [
        {
            "long_url": "https://docs.google.com/",
            "short": "A",
            "hits": 0,
            "group": {
                "id": 2,
                "name": "Test Group",
                "short": "wow",
                "description": "Description of the group",
                "url": "{{ URL::to('/') }}/g/wow"
            },
            "short_url": "https://goo.local/A",
            "qr": {
                "base64": "1TcdDYAfMJNqAAvxewusLbDh+eIg1OXqjeFtvb00cj5APCyGNHrBqVp7+xfCz6RQ65cyevtaKqzVMErWArWF9N0CDgAXOznjb22eh+xl38dHJ53tnhbcmLZX3vEvflXe62YxtW+TZ7ftVXsVD4UALrcFGwA7ttu786rAIBmckqMLgKAw4OZi6blE1tyadXIuzEuBQDGnTRkDwHee5DzEu0eAQAfkOlQ8QoA4EHKzNYwiXVpYxlDaKPQze7IPubIuYbCUNZbA6P4FIY9BYYsnCc9WcmK2A+AN4PMEBsbfMCVT8/890/wQcvtzWzzD1chFDtDsaIiFJfqLFXwCpaCNWBMh52xZfCe5Twzwh57GZGSPnwDZE+zOSjvzujc6Rk0QAcO5OZesoE1JjZWy3lXe9pv/kJbepEa104O4aKxqzt15C0hCfPFLk2ShDzqsk4WT60ne+5l3xixy7l9a5TmzyOw4osovB0AzPwIOoUGzXI2wR3R84l8u0J1lip4BUvBUrC+APT/l5ygYhinPbUAAAAASUVORK5CYII="
            },
            "active_before":"2020-12-15"
        },
        {
            "long_url": "http://test.ru",
            "short": "p",
            "hits": 0,
            "group": {
                "id": 2,
                "name": "Test Group",
                "short": "wow",
                "description": "Description of the group",
                "url": "{{ URL::to('/') }}/g/wow"
            },
            "short_url": "https://goo.local/p",
            "qr": {
                "base64": "1rc1av1mtOveAmEWABxawgAUsBCxgAQtYwFpR1WxuuHieo/JZlKquPv5qh9Ud25/bDQLrbzVFrOxOP0pVMY73+3ZY272afQfiNg+1Zo6crHfNKx3ELAI8sIAFLGAhYAELWMAC1orq2tyw9ESnFXiU+ktYt5t2WLul99XLjiLypf4eJjvKDZnZ9FgbsrjMoz2s4MfTcrJKyXyp3gkcNTuK1DQ7s+pcbTgmJysBHljAAhawELCABSxgAQtYSNG/sv+mdR376s4AAAAASUVORK5CYII="
            },
            "active_before": null
        }
    ]
}

                    </pre>
                </div>
                <h4>Response fields:</h4>
                <p><b>successful  <span class="text-danger"> Boolean  </span></b>  Successful request</p>
                <p><b>message <span class="text-danger"> String </span></b> Text message. By default is NULL</p>
                <p><b>count <span class="text-danger"> Integer  </span></b>  Total number of links on request</p>
                <p><b>limit <span class="text-danger"> Integer  </span></b> The number of links contained in the result.</p>
                <p><b>offset <span class="text-danger"> Integer  </span></b> The number of items to skip.</p>
                <p><b>links <span class="text-danger"> Array of Link </span></b> List of links.</p>
                <p><b>link.long_url <span class="text-danger"> String </span></b> Source url</p>
                <p><b>links[].short <span class="text-danger"> String </span></b> Alias of the short link</p>
                <p><b>links[].hits <span class="text-danger"> Integer  </span></b> Number of clicks on the link</p>
                <p><b>links[].group.id <span class="text-danger"> Integer  </span></b> Id of the link group</p>
                <p><b>links[].group.name  <span class="text-danger"> String </span></b> Name of the link group</p>
                <p><b>links[].group.description <span class="text-danger"> String </span></b> Description of the link group</p>
                <p><b>links[].group.url <span class="text-danger"> String </span></b> Url of the link group</p>
                <p><b>links[].short_url <span class="text-danger"> String </span></b> Short link</p>
                <p><b>links[].qr.base64 <span class="text-danger"> String </span></b> Image of the QR code of the link in base64 format</p>
                <p><b>links[].active_before <span class="text-danger"> Date|null </span></b> The date until which the link will be available. After the expiration of the period, referrals to the link will be unavailable. If this parameter is not set, then the link will always be available.</p>
                <h4>Delete short link</h4>
                <p class="text-danger">POST|DELETE /links/delete/&lt;alias&gt; </p>
                <p>You can remove your short link using the link alias.</p>
                <h4>Request example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
curl --request POST \
  --url https://goo.local/api/links/delete/cool \
  --header 'content-type: application/json' \
  --header 'x-goo-api-token: XXXXXX'
                    </pre>
                </div>
                <h4>Response example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
{
    "successful": true,
    "message": "Link removed"
}
                    </pre>
                </div>

            </div>
        </div>
        <div class="card" id="url">
            <div class="card-header">
                <h2 class="card-title">Groups</h2>
            </div>
            <div class="card-body">

                <h4>Create group</h4>
                <p class="text-danger">POST /groups/create</p>

                <p>Service alows to create groups for your links.</p>
                <h5>Required parameters:</h5>
                <p><b>name<span class="text-danger"> String</span></b> Group name</p>

                <h5>Optional parameters:</h5>
                <p><b>description<span class="text-danger"> String</span></b> Group description. Default NULL</p>
                <p><b>alias<span class="text-danger"> String</span></b> This value will be displayed as an identifier. For example for "super" alias, link to new group will look like this - {{ URL::to('/') }}/g/super. Max length 10 characters. By default, the alias will be randomly generated.</p>
                <p><b>is_active<span class="text-danger"> Boolean</span></b> Whether this link group is publicly viewable. By default value is TRUE</p>
                <p><b>is_rotation<span class="text-danger"> Boolean</span></b> If set, the above URL will redirect to a random link from the group instead of displaying all links belonging to the group. By default value is FALSE</p>
                <h4>Request example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
curl --request POST \
  --url {{ URL::to('/') }}/api/groups/create \
  --header 'content-type: application/json' \
  --header 'x-goo-api-token: XXXXXX' \
  --data '{
	"name":"My links",
	"description":"Links to my social networks",
	"alias": "super",
	"is_active":true,
	"is_rotation":true
}'
                    </pre>
                </div>
                <h4>Response example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
{
    "successful": true,
    "message": "Group created",
    "group": {
        "id": 3,
        "name": "My links",
        "short": "super",
        "description": "Links to my social networks",
        "url": "https://goo.local/g/super"
    }
}
                    </pre>
                </div>
                <h4>Response fields:</h4>
                <p><b>successful<span class="text-danger"> Boolean</span></b> Successful request</p>
                <p><b>message<span class="text-danger"> String</span></b> Text message.</p>
                <p><b>group.id<span class="text-danger"> Integer</span></b> Group ID</p>
                <p><b>group.name<span class="text-danger"> String</span></b>  Group name</p>
                <p><b>group.short<span class="text-danger"> String</span></b> Group alias</p>
                <p><b>group.description<span class="text-danger"> String</span></b> Group description</p>
                <p><b>group.url<span class="text-danger"> String</span></b> Group url</p>

                <h4>List of groups</h4>
                <p class="text-danger">GET /groups</p>
                <p>You can receive list of your groups.</p>

                <h4>Optional parameters:</h4>
                <p><b>limit<span class="text-danger"> Integer</span></b> The number of groups contained in the result. Max value is 100. By default is 100.</p>
                <p><b>offset<span class="text-danger"> Integer</span></b> The number of items to skip. By default is 0.</p>

                <h4>Request example:</h4>

                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
curl --request GET \
  --url {{ URL::to('/') }}/api/groups \
  --header 'token: XXXXX'
                    </pre>
                </div>

                <h4>Response example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
{
    "successful": true,
    "message": "",
    "count": 1,
    "groups": [
        {
            "id": 3,
            "name": "My links",
            "short": "super",
            "description": "Links to my social networks",
            "url": "https://goo.local/g/super"
        }
    ]
}
                    </pre>
                </div>
                <h4>Response fields:</h4>

                <p><b>successful<span class="text-danger"> Boolean</span></b> Successful request</p>
                <p><b>message<span class="text-danger"> String</span></b> Text message.</p>
                <p><b>groups<span class="text-danger"> Array of Group</span></b>  List of your groups.</p>
                <p><b>group.id<span class="text-danger"> String<</span></b> Group id</p>
                <p><b>group.name<span class="text-danger"> String<</span></b> Group name</p>
                <p><b>group.short<span class="text-danger"> String<</span></b> Group alias</p>
                <p><b>group.description<span class="text-danger"> String<</span></b> Group description</p>
                <p><b>group.url<span class="text-danger"> String</span></b> Group url</p>

                <h3>Delete group</h3>

                <p class="text-danger">POST|DELETE /groups/delete/&lt;group_id&gt;</p>
                <p>You can remove your group using the group id.</p>

                <h4>Request example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
curl --request POST \
  --url {{ URL::to('/') }}/api/groups/delete/3 \
  --header 'content-type: application/json' \
  --header 'x-goo-api-token: XXXXX'
                    </pre>
                </div>


                <h4>Response example:</h4>
                <div class="bg-dark border-radius">
                    <pre class="text-white m-0">
{
    "successful": true,
    "message": "Group removed"
}
                    </pre>
                </div>
            </div>
        </div>


    </div>
@endsection
