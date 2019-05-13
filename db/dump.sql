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
