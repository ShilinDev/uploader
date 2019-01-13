---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_7ebdd0ac8b3cd321e05382d1c06cd0b1 -->
## Get the key performance stats for the dashboard.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/stats" 
```

```javascript
const url = new URL("http://localhost/horizon/api/stats");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "jobsPerMinute": 0,
    "processes": 5,
    "queueWithMaxRuntime": null,
    "queueWithMaxThroughput": null,
    "recentlyFailed": 0,
    "recentJobs": 0,
    "status": "running",
    "wait": {
        "redis:default": 0
    }
}
```

### HTTP Request
`GET horizon/api/stats`


<!-- END_7ebdd0ac8b3cd321e05382d1c06cd0b1 -->

<!-- START_5abc89804e68469f8260c0ded520f59c -->
## Get the current queue workload for the application.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/workload" 
```

```javascript
const url = new URL("http://localhost/horizon/api/workload");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[
    {
        "name": "default",
        "length": 0,
        "wait": 0,
        "processes": 5
    }
]
```

### HTTP Request
`GET horizon/api/workload`


<!-- END_5abc89804e68469f8260c0ded520f59c -->

<!-- START_7d6f8da3e735f9175246fbab4b37610c -->
## Get all of the master supervisors and their underlying supervisors.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/masters" 
```

```javascript
const url = new URL("http://localhost/horizon/api/masters");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "59fa382bc7a9-hFsz": {
        "name": "59fa382bc7a9-hFsz",
        "pid": "9",
        "status": "running",
        "supervisors": [
            {
                "name": "59fa382bc7a9-hFsz:supervisor-1",
                "master": "59fa382bc7a9-hFsz",
                "pid": "16",
                "status": "running",
                "processes": {
                    "redis:default": 5
                },
                "options": {
                    "balance": "simple",
                    "connection": "redis",
                    "queue": "default",
                    "delay": "0",
                    "force": false,
                    "maxProcesses": "5",
                    "minProcesses": "1",
                    "maxTries": "3",
                    "memory": "128",
                    "name": "59fa382bc7a9-hFsz:supervisor-1",
                    "sleep": "3",
                    "timeout": "60"
                }
            }
        ]
    }
}
```

### HTTP Request
`GET horizon/api/masters`


<!-- END_7d6f8da3e735f9175246fbab4b37610c -->

<!-- START_3a653cb977489e73ed8798e5705defbf -->
## Get all of the monitored tags and their job counts.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/monitoring" 
```

```javascript
const url = new URL("http://localhost/horizon/api/monitoring");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[]
```

### HTTP Request
`GET horizon/api/monitoring`


<!-- END_3a653cb977489e73ed8798e5705defbf -->

<!-- START_970935b1e560143fd003dd90a6f0b7b0 -->
## Start monitoring the given tag.

> Example request:

```bash
curl -X POST "http://localhost/horizon/api/monitoring" 
```

```javascript
const url = new URL("http://localhost/horizon/api/monitoring");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST horizon/api/monitoring`


<!-- END_970935b1e560143fd003dd90a6f0b7b0 -->

<!-- START_abd3993e15d364e7a2c79c9caa73a862 -->
## Paginate the jobs for a given tag.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/monitoring/{tag}" 
```

```javascript
const url = new URL("http://localhost/horizon/api/monitoring/{tag}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "jobs": [],
    "total": 0
}
```

### HTTP Request
`GET horizon/api/monitoring/{tag}`


<!-- END_abd3993e15d364e7a2c79c9caa73a862 -->

<!-- START_9f62e45bc2a894b92554c1406f487f03 -->
## Stop monitoring the given tag.

> Example request:

```bash
curl -X DELETE "http://localhost/horizon/api/monitoring/{tag}" 
```

```javascript
const url = new URL("http://localhost/horizon/api/monitoring/{tag}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE horizon/api/monitoring/{tag}`


<!-- END_9f62e45bc2a894b92554c1406f487f03 -->

<!-- START_9808e9d7d776f039d57c72f052e6e8cc -->
## Get all of the measured jobs.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/metrics/jobs" 
```

```javascript
const url = new URL("http://localhost/horizon/api/metrics/jobs");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[]
```

### HTTP Request
`GET horizon/api/metrics/jobs`


<!-- END_9808e9d7d776f039d57c72f052e6e8cc -->

<!-- START_dbb28dc188d668f7fa836ee5bc43e243 -->
## Get metrics for a given job.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/metrics/jobs/{id}" 
```

```javascript
const url = new URL("http://localhost/horizon/api/metrics/jobs/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[]
```

### HTTP Request
`GET horizon/api/metrics/jobs/{id}`


<!-- END_dbb28dc188d668f7fa836ee5bc43e243 -->

<!-- START_ca0a10e3b27a3c5820831f79ab403f78 -->
## Get all of the measured queues.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/metrics/queues" 
```

```javascript
const url = new URL("http://localhost/horizon/api/metrics/queues");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[]
```

### HTTP Request
`GET horizon/api/metrics/queues`


<!-- END_ca0a10e3b27a3c5820831f79ab403f78 -->

<!-- START_7a3c56bda1e4b728cf5a5691ee989766 -->
## Get metrics for a given queue.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/metrics/queues/{id}" 
```

```javascript
const url = new URL("http://localhost/horizon/api/metrics/queues/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[]
```

### HTTP Request
`GET horizon/api/metrics/queues/{id}`


<!-- END_7a3c56bda1e4b728cf5a5691ee989766 -->

<!-- START_c34fa16bca5eb044bd9b7d7643c3376a -->
## Get all of the recent jobs.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/jobs/recent" 
```

```javascript
const url = new URL("http://localhost/horizon/api/jobs/recent");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "jobs": [],
    "total": 0
}
```

### HTTP Request
`GET horizon/api/jobs/recent`


<!-- END_c34fa16bca5eb044bd9b7d7643c3376a -->

<!-- START_73a5f0771b8fdd710e2b547f24f1b308 -->
## Get all of the failed jobs.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/jobs/failed" 
```

```javascript
const url = new URL("http://localhost/horizon/api/jobs/failed");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "jobs": [],
    "total": 0
}
```

### HTTP Request
`GET horizon/api/jobs/failed`


<!-- END_73a5f0771b8fdd710e2b547f24f1b308 -->

<!-- START_25959bfc2e37e26b5875453cbf717c3f -->
## Get a failed job instance.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/api/jobs/failed/{id}" 
```

```javascript
const url = new URL("http://localhost/horizon/api/jobs/failed/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[]
```

### HTTP Request
`GET horizon/api/jobs/failed/{id}`


<!-- END_25959bfc2e37e26b5875453cbf717c3f -->

<!-- START_b69e44e22af794a2060e89edd04f0600 -->
## Retry a failed job.

> Example request:

```bash
curl -X POST "http://localhost/horizon/api/jobs/retry/{id}" 
```

```javascript
const url = new URL("http://localhost/horizon/api/jobs/retry/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST horizon/api/jobs/retry/{id}`


<!-- END_b69e44e22af794a2060e89edd04f0600 -->

<!-- START_fb7b7b4614d0392062e423beed14f31f -->
## Single page application catch-all route.

> Example request:

```bash
curl -X GET -G "http://localhost/horizon/{view?}" 
```

```javascript
const url = new URL("http://localhost/horizon/{view?}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
null
```

### HTTP Request
`GET horizon/{view?}`


<!-- END_fb7b7b4614d0392062e423beed14f31f -->

<!-- START_6e7e2bdf41dacf38a5c6768ef817e8b6 -->
## api/upload
> Example request:

```bash
curl -X POST "http://localhost/api/upload" 
```

```javascript
const url = new URL("http://localhost/api/upload");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/upload`


<!-- END_6e7e2bdf41dacf38a5c6768ef817e8b6 -->

<!-- START_ae02407eec1b67e407606bd05b39f9d7 -->
## api/images/{id}
> Example request:

```bash
curl -X GET -G "http://localhost/api/images/{id}" 
```

```javascript
const url = new URL("http://localhost/api/images/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
null
```

### HTTP Request
`GET api/images/{id}`


<!-- END_ae02407eec1b67e407606bd05b39f9d7 -->


