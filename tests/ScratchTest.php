<?php

namespace Omneo;

class ScratchTest extends TestCase
{
    /**
     * @test
     */
    public function test_real_request()
    {
        return;
        $client = new Client('ap21-stage.omneoapp.com', $this->getToken());

        dd($client->interactions()->browse());

        try {
            $interaction = $client->interactions()->add(new Interaction([
                'profile_id' => 1,
                'identity_id' => 1,
                'action' => 'service',
                'channel' => 'support',
                'name' => 'Ticket created',
                'namespace' => 'zendesk',
                'description' => 'This is a test ticket',
                'url' => 'http://example.com/ticket/1',
                'signal' => 0
            ]));
        } catch (\Exception $e) {
            dd((string) $e->getResponse()->getBody());
        }

        dd($interaction);
    }

    protected function getToken()
    {
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE4NDk0ZTY5NjIwM2Y1ODNiODMxMDU2MzQ5MjU0ZGEyNDgwOWIwYmM0OWE1OTdhOWI5NWVkN2E5ZWNmMzk4NjgxZDY1Nzc0NTgwMmQ5ZWQzIn0.eyJhdWQiOiIyIiwianRpIjoiYTg0OTRlNjk2MjAzZjU4M2I4MzEwNTYzNDkyNTRkYTI0ODA5YjBiYzQ5YTU5N2E5Yjk1ZWQ3YTllY2YzOTg2ODFkNjU3NzQ1ODAyZDllZDMiLCJpYXQiOjE1MjQ0Njg0MjksIm5iZiI6MTUyNDQ2ODQyOSwiZXhwIjoxNTU2MDA0NDI5LCJzdWIiOiI1Iiwic2NvcGVzIjpbImNyZWF0ZS1iZW5lZml0LWRlZmluaXRpb25zIiwicmVhZC1iZW5lZml0LWRlZmluaXRpb25zIiwidXBkYXRlLWJlbmVmaXQtZGVmaW5pdGlvbnMiLCJkZWxldGUtYmVuZWZpdC1kZWZpbml0aW9ucyIsImNyZWF0ZS1yZXdhcmQtZGVmaW5pdGlvbnMiLCJyZWFkLXJld2FyZC1kZWZpbml0aW9ucyIsInVwZGF0ZS1yZXdhcmQtZGVmaW5pdGlvbnMiLCJkZWxldGUtcmV3YXJkLWRlZmluaXRpb25zIiwiY3JlYXRlLXBvaW50LWRlZmluaXRpb25zIiwicmVhZC1wb2ludC1kZWZpbml0aW9ucyIsInVwZGF0ZS1wb2ludC1kZWZpbml0aW9ucyIsImRlbGV0ZS1wb2ludC1kZWZpbml0aW9ucyIsImNyZWF0ZS10aWVyLWRlZmluaXRpb25zIiwicmVhZC10aWVyLWRlZmluaXRpb25zIiwidXBkYXRlLXRpZXItZGVmaW5pdGlvbnMiLCJkZWxldGUtdGllci1kZWZpbml0aW9ucyIsImNyZWF0ZS1yZXdhcmRzIiwicmVhZC1yZXdhcmRzIiwiY3JlYXRlLWJlbmVmaXRzIiwicmVhZC1iZW5lZml0cyIsInJlYWQtcG9pbnRzIiwiY3JlYXRlLXByb2ZpbGVzIiwicmVhZC1wcm9maWxlcyIsInVwZGF0ZS1wcm9maWxlcyIsImRlbGV0ZS1wcm9maWxlcyIsImNyZWF0ZS1hdHRyaWJ1dGVzIiwicmVhZC1hdHRyaWJ1dGVzIiwidXBkYXRlLWF0dHJpYnV0ZXMiLCJkZWxldGUtYXR0cmlidXRlcyIsImNyZWF0ZS11c2VycyIsInJlYWQtdXNlcnMiLCJ1cGRhdGUtdXNlcnMiLCJkZWxldGUtdXNlcnMiLCJjcmVhdGUtdHJhbnNhY3Rpb25zIiwicmVhZC10cmFuc2FjdGlvbnMiLCJ1cGRhdGUtdHJhbnNhY3Rpb25zIiwiZGVsZXRlLXRyYW5zYWN0aW9ucyIsImNyZWF0ZS1wcm9kdWN0cyIsInJlYWQtcHJvZHVjdHMiLCJ1cGRhdGUtcHJvZHVjdHMiLCJkZWxldGUtcHJvZHVjdHMiLCJjcmVhdGUtcHJvZHVjdC1vcHRpb25zIiwicmVhZC1wcm9kdWN0LW9wdGlvbnMiLCJ1cGRhdGUtcHJvZHVjdC1vcHRpb25zIiwiZGVsZXRlLXByb2R1Y3Qtb3B0aW9ucyIsImNyZWF0ZS1sb2NhdGlvbnMiLCJyZWFkLWxvY2F0aW9ucyIsInVwZGF0ZS1sb2NhdGlvbnMiLCJkZWxldGUtbG9jYXRpb25zIiwiY3JlYXRlLWludGVyYWN0aW9ucyIsInJlYWQtaW50ZXJhY3Rpb25zIiwicmVhZC1yZWRlbXB0aW9ucyIsInJlZGVlbS1zdHJhdGVneSIsInJlZGVlbS1iZW5lZml0cyIsInJldHVybiIsInJlYWQtbGVkZ2VycyIsImNyZWF0ZS1jdXJyZW5jaWVzIiwicmVhZC1jdXJyZW5jaWVzIiwidXBkYXRlLWN1cnJlbmNpZXMiLCJkZWxldGUtY3VycmVuY2llcyIsImNyZWF0ZS10ZW5hbnRzIiwicmVhZC10ZW5hbnRzIiwidXBkYXRlLXRlbmFudHMiLCJkZWxldGUtdGVuYW50cyIsImNyZWF0ZS13ZWJob29rcyIsInJlYWQtd2ViaG9va3MiLCJ1cGRhdGUtd2ViaG9va3MiLCJkZWxldGUtd2ViaG9va3MiXX0.Xrt_7cZdcN5p9PV7X6gXBAzMII4RUSVyleXELjCPwoqPNjVzQ0WHaIE-D3ufydDfh_C96o-hpgNwl1mZbG_4T9wmeZED46M0FJjcK7yJGVqso2WL-T8mL1nGp42geDszLN8IwEdtdCEezqwYQ72WJcVoeGrZQK5T52jMlMuxDXBstudrCvN1vHcWG0Wt8vqvIY6PagWKfcFbl4W9nmF_vf0FJRsbXLbLqALjkGxl45NZMAOoTF2wmD3fUb_64xdomF_MnOmXXtHD4IefSUTDASSAqRx50kigOZVOJ4NZH6kCYUgHbCZNUDOdPWoFnwDeuT_Cr8ddFvnvBjPaWV_040G4gZogVZVIVxtTs8HpgHM062bj6CDoOICPbZfbphYKgxwUO-weUkw8d2XBGztFs0Dorkf4-HDoKruILTfHjaBxfIBYleaTMOM9IJaaIsQq41m98gQAsW3qsCb0wCflJHar1S7iRFmtq7GlqYY-A8YEyV2Agg6POCZrNG5h4fBAp3lpC5hXT9idM02l5-crhneMoDBEprJxE9Dyg8FQmMuByDuJbJPOulThLQVaJ5eI-v7Mx-VkUUZTffS6TToonPa3gpH0X_sw9F8yXgddN4qt3IDLLYNY5rqxwbI8Q2IlnkqEf50OyvyeLhQm9DlqnefF24o7YnfyNmaGIIjeGCo';
    }
}