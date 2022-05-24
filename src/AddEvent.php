<?php

	namespace AddEventPHP;

	use Curl\Curl;

	class AddEvent {

		private $token;

		public function __construct(string $token) {

			$this->token = $token;
			$this->curl = new Curl();
			$this->baseUrl = 'https://www.addevent.com/api/v1';
		}

		// Calendar Endpoints

		public function listCalendars($page) {

			$this->curl->get($this->baseUrl . '/me/calendars/list', [ 'token' => $this->token ]);
			if(isset($page)) $this->curl->get($page);
			$response = json_decode($this->curl->response);
			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {
				$response->calendars = json_decode(json_encode($response->calendars), true);
				return $response;
			}

			return false;
		}

		public function createCalendar($title, $description, $props = []) {

			$this->curl->get($this->baseUrl . '/me/calendars/create', array_merge([
				'title' => $title,
				'description' => $description,
				'token' => $this->token
			], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->calendar;
			}

			return false;
		}

		public function updateCalendar($calendar_id, $title, $description, $props = []) {

			$this->curl->get($this->baseUrl . '/me/calendars/save', array_merge([
				'calendar_id' => $calendar_id,
				'title' => $title,
				'description' => $description,
				'token' => $this->token
			], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->calendar;
			}

			return false;
		}

		public function deleteCalendar($calendar_id) {

			$this->curl->get($this->baseUrl . '/me/calendars/save', [
				'calendar_id' => $calendar_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->calendar;
			}

			return false;
		}

		public function listCalendarEvents($calendar_id, $props = []) {

			$this->curl->get($this->baseUrl . '/me/calendars/events/list', array_merge([
				'calendar_id' => $calendar_id,
				'token' => $this->token
			], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return ['calendar' => $response->calendar, 'events' => $response->events];
			}

			return false;
		}

		public function listEventsAcrossAllCalendar($calendar_id, $props = []) {

			$this->curl->get($this->baseUrl . '/me/calendars/events/all', array_merge([
				'token' => $this->token
			], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->events;
			}

			return false;
		}

		public function createCalendarEvent($calendar_id, $props = []) {

			$this->curl->get($this->baseUrl . '/me/calendars/events/create', array_merge(['token' => $this->token], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->event;
			}

			return false;
		}

		public function saveCalendarEvent($event_id, $props = []) {

			$this->curl->get($this->baseUrl . '/me/calendars/events/save', array_merge(['token' => $this->token], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->event;
			}

			return false;
		}

		public function deleteCalendarEvent($event_id) {

			$this->curl->get($this->baseUrl . '/me/calendars/events/delete', [
				'event_id' => $event_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->event;
			}

			return false;
		}

		public function listSubscribers($calendar_id) {

			$this->curl->get($this->baseUrl . '/me/calendars/subscribers/list', [
				'calendar_id' => $calendar_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return [
					'summary' => $response->summary,
					'calendar' => $response->calendar
				];
			}

			return false;
		}

		public function viewSubscriber($calendar_id, $user_id) {

			$this->curl->get($this->baseUrl . '/me/calendars/subscribers/subscriber', [
				'user_id' => $user_id,
				'calendar_id' => $calendar_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return [
					'calendar' => $response->calendar,
					'subscriber' => $response->subscriber
				];
			}

			return false;
		}

		public function deleteSubscriber($calendar_id, $user_id) {

			$this->curl->get($this->baseUrl . '/me/calendars/subscribers/subscriber', [
				'user_id' => $user_id,
				'calendar_id' => $calendar_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return [
					'calendar' => $response->calendar
				];
			}

			return false;
		}

		public function listTimezones() {

			$this->curl->get($this->baseUrl . '/timezones');

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->data;
			}

			return false;
		}

		// Events Endpoints

		public function listEvents($calendar_id, $props = []) {

			$this->curl->get($this->baseUrl . '/oe/events/list', array_merge([
				'calendar_id' => $calendar_id,
				'token' => $this->token
			], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return [
					'calendar' => $response->calendar,
					'events' => $response->events
				];
			}

			return false;
		}

		public function createEvent($calendar_id, $props = []) {

			$this->curl->get($this->baseUrl . '/oe/events/create', array_merge([
				'calendar_id' => $calendar_id,
				'token' => $this->token
			], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->event;
			}

			return false;
		}

		public function saveEvent($event_id, $props = []) {

			$this->curl->get($this->baseUrl . '/oe/events/save', array_merge([
				'event_id' => $event_id,
				'token' => $this->token
			], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->event;
			}

			return false;
		}

		public function deleteEvent($event_id) {

			$this->curl->get($this->baseUrl . '/oe/events/delete', [
				'event_id' => $event_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->event;
			}

			return false;
		}

		public function viewEvent($event_id) {

			$this->curl->get($this->baseUrl . '/oe/events/event', [
				'event_id' => $event_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->event;
			}

			return false;
		}

		public function listRSPVs($event_id) {

			$this->curl->get($this->baseUrl . '/oe/rsvps/list', [
				'event_id' => $event_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return [
					'summary' => $response->summary,
					'rsvps' => $response->rsvps
				];
			}

			return false;
		}

		public function viewRSVPAttendee($event_id, $user_id) {

			$this->curl->get($this->baseUrl . '/oe/rsvps/attendee', [
				'user_id' => $user_id,
				'event_id' => $event_id,
				'token' => $this->token
			]);

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->rsvps;
			}

			return false;
		}

		public function createRSVPAttendee($event_id, $props = []) {

			$this->curl->get($this->baseUrl . '/oe/rsvps/attendee/create', array_merge([
				'event_id' => $event_id,
				'token' => $this->token
			], $props));

			$response = json_decode($this->curl->response);

			if($response && isset($response->meta) && isset($response->meta->code) && $response->meta->code == 200) {

				return $response->attendee;
			}

			return false;
		}
	}
?>