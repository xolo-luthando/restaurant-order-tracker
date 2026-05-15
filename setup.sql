--
-- PostgreSQL database dump
--

\restrict EYIGBgDWGUYdN7wYNmorbjMRaKAMBgpajg5AriKgOKeccSO4YJRa6yaGcH66cAg

-- Dumped from database version 18.3
-- Dumped by pg_dump version 18.3

-- Started on 2026-05-15 14:32:36

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 224 (class 1259 OID 16550)
-- Name: orders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.orders (
    order_id integer NOT NULL,
    customer_id integer,
    staff_id integer,
    restaurant_id integer,
    status character varying(20) DEFAULT 'pending'::character varying,
    "timestamp" timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.orders OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16549)
-- Name: orders_order_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.orders_order_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.orders_order_id_seq OWNER TO postgres;

--
-- TOC entry 5057 (class 0 OID 0)
-- Dependencies: 223
-- Name: orders_order_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.orders_order_id_seq OWNED BY public.orders.order_id;


--
-- TOC entry 226 (class 1259 OID 16560)
-- Name: ratings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ratings (
    rating_id integer NOT NULL,
    order_id integer,
    rating character varying(10),
    customer_id integer
);


ALTER TABLE public.ratings OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16559)
-- Name: ratings_rating_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ratings_rating_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.ratings_rating_id_seq OWNER TO postgres;

--
-- TOC entry 5058 (class 0 OID 0)
-- Dependencies: 225
-- Name: ratings_rating_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ratings_rating_id_seq OWNED BY public.ratings.rating_id;


--
-- TOC entry 227 (class 1259 OID 16574)
-- Name: restaurant_staff; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.restaurant_staff (
    restaurant_id integer NOT NULL,
    staff_id integer NOT NULL,
    job_title character varying(50)
);


ALTER TABLE public.restaurant_staff OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 16542)
-- Name: restaurants; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.restaurants (
    restaurant_id integer NOT NULL,
    name character varying(100)
);


ALTER TABLE public.restaurants OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16541)
-- Name: restaurants_restaurant_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.restaurants_restaurant_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.restaurants_restaurant_id_seq OWNER TO postgres;

--
-- TOC entry 5059 (class 0 OID 0)
-- Dependencies: 221
-- Name: restaurants_restaurant_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.restaurants_restaurant_id_seq OWNED BY public.restaurants.restaurant_id;


--
-- TOC entry 220 (class 1259 OID 16534)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    name character varying(100),
    password character varying(100),
    role character varying(20)
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16533)
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_user_id_seq OWNER TO postgres;

--
-- TOC entry 5060 (class 0 OID 0)
-- Dependencies: 219
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- TOC entry 4877 (class 2604 OID 16553)
-- Name: orders order_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders ALTER COLUMN order_id SET DEFAULT nextval('public.orders_order_id_seq'::regclass);


--
-- TOC entry 4880 (class 2604 OID 16563)
-- Name: ratings rating_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratings ALTER COLUMN rating_id SET DEFAULT nextval('public.ratings_rating_id_seq'::regclass);


--
-- TOC entry 4876 (class 2604 OID 16545)
-- Name: restaurants restaurant_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.restaurants ALTER COLUMN restaurant_id SET DEFAULT nextval('public.restaurants_restaurant_id_seq'::regclass);


--
-- TOC entry 4875 (class 2604 OID 16537)
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- TOC entry 5048 (class 0 OID 16550)
-- Dependencies: 224
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orders (order_id, customer_id, staff_id, restaurant_id, status, "timestamp") FROM stdin;
\.


--
-- TOC entry 5050 (class 0 OID 16560)
-- Dependencies: 226
-- Data for Name: ratings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ratings (rating_id, order_id, rating, customer_id) FROM stdin;
\.


--
-- TOC entry 5051 (class 0 OID 16574)
-- Dependencies: 227
-- Data for Name: restaurant_staff; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.restaurant_staff (restaurant_id, staff_id, job_title) FROM stdin;
1	1	Cashier
\.


--
-- TOC entry 5046 (class 0 OID 16542)
-- Dependencies: 222
-- Data for Name: restaurants; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.restaurants (restaurant_id, name) FROM stdin;
1	Pizza Palace
2	Burger Barn
\.


--
-- TOC entry 5044 (class 0 OID 16534)
-- Dependencies: 220
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (user_id, name, password, role) FROM stdin;
1			
2			
3			
4	John Staff	hashedpassword	staff
5	Jane Customer	hashedpassword	customer
\.


--
-- TOC entry 5061 (class 0 OID 0)
-- Dependencies: 223
-- Name: orders_order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orders_order_id_seq', 1, false);


--
-- TOC entry 5062 (class 0 OID 0)
-- Dependencies: 225
-- Name: ratings_rating_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ratings_rating_id_seq', 1, false);


--
-- TOC entry 5063 (class 0 OID 0)
-- Dependencies: 221
-- Name: restaurants_restaurant_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.restaurants_restaurant_id_seq', 2, true);


--
-- TOC entry 5064 (class 0 OID 0)
-- Dependencies: 219
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_user_id_seq', 5, true);


--
-- TOC entry 4886 (class 2606 OID 16558)
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (order_id);


--
-- TOC entry 4888 (class 2606 OID 16566)
-- Name: ratings ratings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT ratings_pkey PRIMARY KEY (rating_id);


--
-- TOC entry 4892 (class 2606 OID 16580)
-- Name: restaurant_staff restaurant_staff_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.restaurant_staff
    ADD CONSTRAINT restaurant_staff_pkey PRIMARY KEY (restaurant_id, staff_id);


--
-- TOC entry 4884 (class 2606 OID 16548)
-- Name: restaurants restaurants_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.restaurants
    ADD CONSTRAINT restaurants_pkey PRIMARY KEY (restaurant_id);


--
-- TOC entry 4890 (class 2606 OID 16568)
-- Name: ratings unique_rating; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT unique_rating UNIQUE (order_id, customer_id);


--
-- TOC entry 4882 (class 2606 OID 16540)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- TOC entry 4893 (class 2606 OID 16569)
-- Name: ratings ratings_customer_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ratings
    ADD CONSTRAINT ratings_customer_id_fkey FOREIGN KEY (customer_id) REFERENCES public.users(user_id);


--
-- TOC entry 4894 (class 2606 OID 16581)
-- Name: restaurant_staff restaurant_staff_restaurant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.restaurant_staff
    ADD CONSTRAINT restaurant_staff_restaurant_id_fkey FOREIGN KEY (restaurant_id) REFERENCES public.restaurants(restaurant_id);


--
-- TOC entry 4895 (class 2606 OID 16586)
-- Name: restaurant_staff restaurant_staff_staff_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.restaurant_staff
    ADD CONSTRAINT restaurant_staff_staff_id_fkey FOREIGN KEY (staff_id) REFERENCES public.users(user_id);


-- Completed on 2026-05-15 14:32:37

--
-- PostgreSQL database dump complete
--

\unrestrict EYIGBgDWGUYdN7wYNmorbjMRaKAMBgpajg5AriKgOKeccSO4YJRa6yaGcH66cAg

