--
-- PostgreSQL database dump
--

-- Dumped from database version 10.7 (Debian 10.7-1.pgdg90+1)
-- Dumped by pg_dump version 10.7 (Debian 10.7-1.pgdg90+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner:
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner:
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: asset_statuses; Type: TABLE; Schema: public; Owner: testuser
--

CREATE TABLE public.asset_statuses (
    asset_id character varying(36) NOT NULL,
    id character varying(36) NOT NULL,
    status_type character varying(10) NOT NULL,
    created_at character varying(25) NOT NULL
);


ALTER TABLE public.asset_statuses OWNER TO testuser;

--
-- Data for Name: asset_statuses; Type: TABLE DATA; Schema: public; Owner: testuser
--

COPY public.asset_statuses (asset_id, id, status_type, created_at) FROM stdin;
179ad179-19d2-4623-97ad-49a8584d1705	67247f96-1b1a-48e5-82b4-5277d4438b3c	NORMAL	2010-01-05T17:56:31Z
e1b993c9-35e3-443e-96ea-5f8e3bb24590	51f135d2-2648-4eb0-bc8e-5727b7cd6f13	NORMAL	2010-01-07T10:29:13Z
29e7ca67-969e-4a00-a321-5c3035087edd	fbbcaf29-a72f-48f7-8f2b-d5abf8bc24bf	NORMAL	2010-01-09T20:47:34Z
d0a4e0e0-869b-4f42-acf5-1005cad14b25	74b1cc05-36e9-41e4-8c77-516f15a8f8bc	NORMAL	2010-01-15T12:21:47Z
9ec75170-3169-4f7f-953c-a9f1cb494406	a7ea0a72-1ef1-4035-a54f-4924095fa786	NORMAL	2010-01-17T02:26:21Z
adac8515-8488-4b13-beaa-9257dc6da68b	62d98170-ff7e-4ee1-8f1c-b54f8aed351c	NORMAL	2010-01-17T06:56:41Z
faee87d3-2ec9-4e96-9f5b-2ca8306f475c	12a594e4-f51f-407e-9d01-679a8323a3c0	NORMAL	2010-01-25T03:45:39Z
d2490ea0-f8b9-4d3c-88dd-74983bf3e803	8fded256-979f-402c-aacc-8ab6b98787d1	NORMAL	2010-01-26T07:32:35Z
c0bec4f3-189c-4d87-9a41-8e4483b128e4	f23658be-e1cf-4e90-aa7d-d2c81a919bf5	NORMAL	2010-01-31T20:48:04Z
b65ae63b-11b5-4fb2-b43a-45366e532e6c	d317bd8d-c32e-4b6c-86da-69c5066de862	NORMAL	2010-02-03T00:14:13Z
806046b2-dbe9-41fd-8c52-4905b537e25d	8786cc43-230d-4ac9-8827-5287f4bfa7d8	NORMAL	2010-02-05T09:38:50Z
e448e186-0307-42f7-8d46-fe7419ca0383	08b86fa4-b2be-4005-93e9-35d08b4c17a7	NORMAL	2010-02-11T11:00:11Z
645b54d9-a469-4e0a-8115-07adef7e14d9	4f436a0d-903b-46bd-8e45-46c1dd3dc631	WARNING	2010-02-14T17:06:46Z
b338a771-d1bb-47f1-acbe-5c58e3ca1dc9	5cd0c05f-2a39-4ea5-b0ea-0dedb3e5b968	NORMAL	2010-02-20T03:29:07Z
158e762a-34e2-4eaa-940c-0e4984accb94	f1aa3b54-6238-4e67-b3ea-a5bc13b77dd0	NORMAL	2010-02-20T20:12:42Z
7d210401-0f04-4040-b948-9978565ad6e5	fbb87862-df95-4644-8186-adc82bcbb610	NORMAL	2010-02-22T18:36:07Z
c55d52cb-9e06-46b6-b093-bbef6de76470	c3ee6d5b-7652-4428-9fe3-842641ba51b6	WARNING	2010-02-23T22:27:59Z
6141b9a2-7399-4eb2-a42f-8de2a0800932	589b8734-a2a9-45ce-a510-138a9c1afa5b	NORMAL	2010-03-03T21:19:10Z
7de01846-f0f8-431d-a80c-ec7159ce44dc	ab8b0b33-2299-476f-9442-ab6ea406b444	NORMAL	2010-03-05T21:27:08Z
41ba76ed-445a-4d43-aef4-2c7be481b539	f07ce021-f224-4606-b16f-4c8b38797790	NORMAL	2010-03-16T16:58:39Z
acc3c45c-414d-4cea-85ae-12c136b1ca74	ce8b0d14-9f87-4725-956d-c982519e02f0	NORMAL	2010-03-28T19:47:16Z
022b8ae9-2d89-4ba6-b7f4-8f83bac41cb6	62a7c8e0-1e8d-44f4-ab95-6dff4a432b29	NORMAL	2010-04-06T11:00:24Z
3bcdea13-2363-4cd8-b0e1-d10acfbd1db2	4d642eef-ff1e-4c4a-9d17-318dc696a90c	NORMAL	2010-04-14T02:38:31Z
9a7e2018-d7b4-4c5b-84bc-5048f37b37b8	b76782b6-4632-4144-83a4-efc874ba24d0	WARNING	2010-05-23T22:32:11Z
4771c5a2-6e21-4786-a08d-81af9224f3ef	91acbf58-e7ea-4790-b58a-7442d2a32109	WARNING	2010-06-02T15:46:38Z
643bb3f4-4858-40dc-95aa-9873e4ce5237	18a5ba9a-7a0f-4c09-a836-8e2ef2da79ca	NORMAL	2010-06-13T20:46:38Z
a4989c65-e273-43fb-81a9-626f9f04ddc2	3ff94130-4435-452e-80e8-0f0fbfe27c72	NORMAL	2010-06-20T18:45:11Z
e7fe7092-342c-4d4f-88e5-ce368711839d	e4c52414-9776-451d-ba80-f3f46b77686b	NORMAL	2010-07-27T22:58:55Z
181c5e36-05ae-42aa-89c7-c42a24934660	d4250e33-f81f-408f-855a-36414fe4cee5	ERROR	2010-09-07T01:48:20Z
1ff6f319-1f80-4b09-95d2-fb5780e3516a	0ec611aa-e0af-4bdc-8d9b-b2f480fd694c	WARNING	2010-10-01T16:21:36Z
\.


--
-- Name: asset_statuses asset_statuses_id_key; Type: CONSTRAINT; Schema: public; Owner: testuser
--

ALTER TABLE ONLY public.asset_statuses
    ADD CONSTRAINT asset_statuses_id_key UNIQUE (id);


--
-- Name: asset_statuses asset_statuses_pkey; Type: CONSTRAINT; Schema: public; Owner: testuser
--

ALTER TABLE ONLY public.asset_statuses
    ADD CONSTRAINT asset_statuses_pkey PRIMARY KEY (asset_id);


--
-- Name: asset_statuses_created_at_index; Type: INDEX; Schema: public; Owner: testuser
--

CREATE INDEX asset_statuses_created_at_index ON public.asset_statuses USING btree (created_at DESC);


--
-- Name: asset_statuses_status_type_index; Type: INDEX; Schema: public; Owner: testuser
--

CREATE INDEX asset_statuses_status_type_index ON public.asset_statuses USING btree (status_type);


--
-- PostgreSQL database dump complete
--
