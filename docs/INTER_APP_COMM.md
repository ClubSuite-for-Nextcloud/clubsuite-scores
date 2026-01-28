Inter-App Communication (Noten)

Kurzdarstellung des Event-Modells für Noten.

Events: Basic, Callback, RequestData.

Sender-Beispiel:
```
$eventService->dispatchRequestDataEvent(function($data){ /* handle */ });
```
