toc.dat                                                                                             0000600 0004000 0002000 00000034316 14437521121 0014446 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP       0        
            {            Study_Management    15.2    15.2 -    ;           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false         <           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false         =           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false         >           1262    16406    Study_Management    DATABASE     �   CREATE DATABASE "Study_Management" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
 "   DROP DATABASE "Study_Management";
                postgres    false         �            1259    16507    contract_type    TABLE     �  CREATE TABLE public.contract_type (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    short_name character varying(255),
    note text,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);
 !   DROP TABLE public.contract_type;
       public         heap    postgres    false         �            1259    16506    contract_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.contract_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.contract_type_id_seq;
       public          postgres    false    224         ?           0    0    contract_type_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.contract_type_id_seq OWNED BY public.contract_type.id;
          public          postgres    false    223         �            1259    16423    departments    TABLE     �  CREATE TABLE public.departments (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    short_name character varying(255),
    note text,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);
    DROP TABLE public.departments;
       public         heap    postgres    false         �            1259    16422    departments_id_seq    SEQUENCE     �   CREATE SEQUENCE public.departments_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.departments_id_seq;
       public          postgres    false    216         @           0    0    departments_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.departments_id_seq OWNED BY public.departments.id;
          public          postgres    false    215         �            1259    16433 	   positions    TABLE     �  CREATE TABLE public.positions (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    short_name character varying(255),
    note text,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);
    DROP TABLE public.positions;
       public         heap    postgres    false         �            1259    16432    positions_id_seq    SEQUENCE     �   CREATE SEQUENCE public.positions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.positions_id_seq;
       public          postgres    false    218         A           0    0    positions_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.positions_id_seq OWNED BY public.positions.id;
          public          postgres    false    217         �            1259    16443    profiles    TABLE       CREATE TABLE public.profiles (
    id integer NOT NULL,
    employee_id character varying(15) NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    birthday timestamp without time zone,
    position_id integer NOT NULL,
    department_id integer NOT NULL,
    status smallint,
    address character varying(255),
    telephone character varying(20),
    mobile character varying(20),
    official_date date,
    probation_date date,
    gender smallint,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255),
    image character varying(255)
);
    DROP TABLE public.profiles;
       public         heap    postgres    false         �            1259    16442    profiles_id_seq    SEQUENCE     �   CREATE SEQUENCE public.profiles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.profiles_id_seq;
       public          postgres    false    220         B           0    0    profiles_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.profiles_id_seq OWNED BY public.profiles.id;
          public          postgres    false    219         �            1259    16407    user    TABLE     �   CREATE TABLE public."user" (
    id integer NOT NULL,
    username character varying(30) NOT NULL,
    password character varying(255) NOT NULL,
    image bytea
);
    DROP TABLE public."user";
       public         heap    postgres    false         �            1259    16483    users    TABLE     �  CREATE TABLE public.users (
    id integer NOT NULL,
    login_id character varying(30) NOT NULL,
    contract_type_id integer,
    profile_id integer NOT NULL,
    password character varying(255) NOT NULL,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);
    DROP TABLE public.users;
       public         heap    postgres    false         �            1259    16482    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    222         C           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    221         �           2604    16510    contract_type id    DEFAULT     t   ALTER TABLE ONLY public.contract_type ALTER COLUMN id SET DEFAULT nextval('public.contract_type_id_seq'::regclass);
 ?   ALTER TABLE public.contract_type ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    224    223    224         }           2604    16426    departments id    DEFAULT     p   ALTER TABLE ONLY public.departments ALTER COLUMN id SET DEFAULT nextval('public.departments_id_seq'::regclass);
 =   ALTER TABLE public.departments ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216         �           2604    16436    positions id    DEFAULT     l   ALTER TABLE ONLY public.positions ALTER COLUMN id SET DEFAULT nextval('public.positions_id_seq'::regclass);
 ;   ALTER TABLE public.positions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218         �           2604    16446    profiles id    DEFAULT     j   ALTER TABLE ONLY public.profiles ALTER COLUMN id SET DEFAULT nextval('public.profiles_id_seq'::regclass);
 :   ALTER TABLE public.profiles ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219    220         �           2604    16486    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221    222         8          0    16507    contract_type 
   TABLE DATA           �   COPY public.contract_type (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    224       3384.dat 0          0    16423    departments 
   TABLE DATA           �   COPY public.departments (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    216       3376.dat 2          0    16433 	   positions 
   TABLE DATA           �   COPY public.positions (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    218       3378.dat 4          0    16443    profiles 
   TABLE DATA           �   COPY public.profiles (id, employee_id, name, email, birthday, position_id, department_id, status, address, telephone, mobile, official_date, probation_date, gender, del_flag, updated_time, updated_user, created_time, created_user, image) FROM stdin;
    public          postgres    false    220       3380.dat .          0    16407    user 
   TABLE DATA           ?   COPY public."user" (id, username, password, image) FROM stdin;
    public          postgres    false    214       3374.dat 6          0    16483    users 
   TABLE DATA           �   COPY public.users (id, login_id, contract_type_id, profile_id, password, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    222       3382.dat D           0    0    contract_type_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.contract_type_id_seq', 4, true);
          public          postgres    false    223         E           0    0    departments_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.departments_id_seq', 4, true);
          public          postgres    false    215         F           0    0    positions_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.positions_id_seq', 7, true);
          public          postgres    false    217         G           0    0    profiles_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.profiles_id_seq', 42, true);
          public          postgres    false    219         H           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 39, true);
          public          postgres    false    221         �           2606    16515     contract_type contract_type_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.contract_type
    ADD CONSTRAINT contract_type_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.contract_type DROP CONSTRAINT contract_type_pkey;
       public            postgres    false    224         �           2606    16431    departments departments_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.departments DROP CONSTRAINT departments_pkey;
       public            postgres    false    216         �           2606    16441    positions positions_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.positions
    ADD CONSTRAINT positions_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.positions DROP CONSTRAINT positions_pkey;
       public            postgres    false    218         �           2606    16451    profiles profiles_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.profiles DROP CONSTRAINT profiles_pkey;
       public            postgres    false    220         �           2606    16411    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public            postgres    false    214         �           2606    16491    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    222         �           2606    16457 $   profiles profiles_department_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_department_id_fkey FOREIGN KEY (department_id) REFERENCES public.departments(id);
 N   ALTER TABLE ONLY public.profiles DROP CONSTRAINT profiles_department_id_fkey;
       public          postgres    false    220    216    3220         �           2606    16452 "   profiles profiles_position_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_position_id_fkey FOREIGN KEY (position_id) REFERENCES public.positions(id);
 L   ALTER TABLE ONLY public.profiles DROP CONSTRAINT profiles_position_id_fkey;
       public          postgres    false    220    3222    218         �           2606    16492    users users_profile_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_profile_id_fkey FOREIGN KEY (profile_id) REFERENCES public.profiles(id);
 E   ALTER TABLE ONLY public.users DROP CONSTRAINT users_profile_id_fkey;
       public          postgres    false    3224    220    222                                                                                                                                                                                                                                                                                                                          3384.dat                                                                                            0000600 0004000 0002000 00000000550 14437521121 0014253 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Full Time	FT		0	2023-05-31 09:43:32.870201	haupham	2023-05-31 09:43:32.870201	haupham
2	Part Time	PT		0	2023-05-31 09:43:44.265355	haupham	2023-05-31 09:43:44.265355	haupham
3	Probation	Proba		0	2023-05-31 09:44:21.125684	haupham	2023-05-31 09:44:21.125684	haupham
4	Intern	Inter		0	2023-05-31 09:44:42.905764	haupham	2023-05-31 09:44:42.905764	haupham
\.


                                                                                                                                                        3376.dat                                                                                            0000600 0004000 0002000 00000000602 14437521121 0014252 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Trainning Department	AAO		0	2023-05-17 10:16:14.71652	haupham	2023-05-17 10:16:14.71652	haupham
2	Financial Planning Division	FPD		0	2023-05-17 10:18:45.212897	haupham	2023-05-17 10:18:45.212897	haupham
3	Accountant	ACC		0	2023-05-17 10:19:55.288848	haupham	2023-05-17 10:19:55.288848	haupham
4	Teacher	TE		0	2023-05-17 10:20:24.052323	haupham	2023-05-17 10:20:24.052323	haupham
\.


                                                                                                                              3378.dat                                                                                            0000600 0004000 0002000 00000001211 14437521121 0014251 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Accountant	ACC		0	2023-05-17 10:34:20.014882	haupham	2023-05-17 10:34:20.014882	haupham
2	Teacher	TE		0	2023-05-17 10:34:54.675249	haupham	2023-05-17 10:34:54.675249	haupham
3	Head of Training	HOT		0	2023-05-31 09:50:14.778821	haupham	2023-05-31 09:50:14.778821	haupham
4	Teacher Part Time	TPT		0	2023-05-31 09:50:51.835228	haupham	2023-05-31 09:50:51.835228	haupham
5	Treasurer	TRE		0	2023-05-31 10:16:37.440379	haupham	2023-05-31 10:16:37.440379	haupham
6	Treasurer	TRE		0	2023-05-31 11:24:53.670814	haupham	2023-05-31 11:24:53.670814	haupham
7	Chief Accountant	CACC		0	2023-05-31 13:03:02.474441	haupham	2023-05-31 13:03:02.474441	haupham
\.


                                                                                                                                                                                                                                                                                                                                                                                       3380.dat                                                                                            0000600 0004000 0002000 00000011775 14437521121 0014262 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        14	123456039	Pham Cong Hau	haupham.123nm@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 11:06:57	2023-05-24 14:56:41	2023-05-17 16:50:31.568112	haupham	
34	123456	Pham Cong Hau	haupham.vm123@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 11:06:57	2023-05-24 16:14:47	2023-05-17 16:50:36.003569	haupham	\N
11	12345659596	Pham Cong Hau	haupham.k123@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 11:36:37	haupham12345	2023-05-17 16:50:30.974446	haupham	\N
15	123456059	Pham Cong Hau	haupham.123ef@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 11:06:57	haupham12345	2023-05-17 16:50:31.741949	haupham	\N
19	123456598702	Pham Cong Hau	haupham.1123@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 13:21:13	haupham12345	2023-05-17 16:50:32.689452	haupham	image-02.jpg
4	123456645	Pham Cong Hau	haupham.123abc@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-17 16:50:24.885134	haupham	2023-05-17 16:50:24.885134	haupham	\N
5	123456089	Pham Cong Hau	haupham.a123@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 08:39:15	haupham12345	2023-05-17 16:50:26.832701	haupham	\N
7	123456701	Pham Cong Hau	haupham.ab123@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 10:11:43	haupham12345	2023-05-17 16:50:29.375482	haupham	\N
8	123456035	Pham Cong Hau	haupham.123a@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 10:15:14	haupham12345	2023-05-17 16:50:29.858229	haupham	\N
16	123456598	Pham Cong Hau	haupham.d123@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 13:07:17	haupham12345	2023-05-17 16:50:31.91845	haupham	\N
10	1234560395	Pham Cong Hau	haupham.f123@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 11:10:02	haupham12345	2023-05-17 16:50:30.720136	haupham	\N
17	1234569534	Pham Cong Hau	haupham.ac123@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-23 13:11:05	haupham12345	2023-05-17 16:50:32.10952	haupham	\N
42	101619	Pham Cong Hau	hau.pham123@gmail.com	2023-05-31 13:36:00	1	1	1		02412131510	0943765795	2023-05-31	2023-05-18	1	0	2023-06-02 17:14:42.03272	haupham12345	2023-05-31 13:39:40.258073	haupham12345	image-02.jpg
36	1234569	Pham Cong Hau	haupham.123@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-25 10:44:34	haupham12345	2023-05-17 16:50:36.336501	haupham	\N
35	12345658975	Pham Cong Hau	haupham.kcn123@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-25 10:55:48	haupham12345	2023-05-17 16:50:36.174815	haupham	\N
37	123456	Pham Cong Hau	haupham.123@gmail.com	2000-01-01 00:00:00	2	1	1	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	2	0	2023-05-17 16:50:36.552969	haupham	2023-05-17 16:50:36.552969	haupham	\N
13	1234565695	Pham Cong Hau	haupham.g123@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-31 11:24:23	haupham12345	2023-05-17 16:50:31.358353	haupham	image-01.jpg
38	12346978	Pham Cong Hau	haupham.123km@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	2	0	2023-05-23 13:17:03	haupham12345	2023-05-18 10:07:33.558502	haupham	image-01.jpg
39	12347	Pham Cong Hau	haupham.123@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	2	0	2023-05-18 10:07:37.341764	haupham	2023-05-18 10:07:37.341764	haupham	image-01.jpg
3	1234561	Pham Cong Hau	haupham.v123@gmail.com	2000-01-01 00:00:00	2	1	2	123, Tran Phu Street, Ward Da Cao, District 1, Ho Chi Minh City	02123456	09425631	2023-10-05	2023-02-03	1	0	2023-05-31 09:54:08	haupham12345	2023-05-17 10:35:34.991418	haupham	\N
\.


   3374.dat                                                                                            0000600 0004000 0002000 00000000056 14437521121 0014253 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	hau	123	\N
2	hau1	123	\N
3	hau2	123	\N
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  3382.dat                                                                                            0000600 0004000 0002000 00000004714 14437521121 0014257 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        18	haupham1234567	1	19	25d55ad283aa400af464c76d713c07ad	0	2023-05-23 13:21:13	haupham12345	2023-05-18 09:15:33.638718	haupham
4	haupham123201	1	5	25d55ad283aa400af464c76d713c07ad	0	2023-05-23 08:39:15	haupham12345	2023-05-18 09:14:50.629086	haupham
15	haupham1236987	1	16	25d55ad283aa400af464c76d713c07ad	0	2023-05-23 13:07:17	haupham12345	2023-05-18 09:15:25.125309	haupham
16	haupham1239875	1	17	25d55ad283aa400af464c76d713c07ad	0	2023-05-23 13:11:05	haupham12345	2023-05-18 09:15:27.935489	haupham
35	haupham1239	1	36	25d55ad283aa400af464c76d713c07ad	0	2023-05-25 10:44:34	haupham12345	2023-05-18 09:16:24.111256	haupham
6	haupham123456	2	7	25d55ad283aa400af464c76d713c07ad	0	2023-05-23 10:11:43	haupham12345	2023-05-18 09:14:58.204291	haupham
7	haupham123521	2	8	25d55ad283aa400af464c76d713c07ad	0	2023-05-23 10:15:14	haupham12345	2023-05-18 09:15:02.163243	haupham
33	haupham12311	3	34	25d55ad283aa400af464c76d713c07ad	0	2023-05-24 16:14:47	haupham12345	2023-05-18 09:16:18.957189	haupham
14	haupham123951	4	15	25d55ad283aa400af464c76d713c07ad	0	2023-05-23 11:06:57	haupham12345	2023-05-18 09:15:21.90301	haupham
9	haupham123592	3	10	25d55ad283aa400af464c76d713c07ad	0	2023-05-23 11:10:02	haupham12345	2023-05-18 09:15:09.092317	haupham
34	haupham1230	3	35	25d55ad283aa400af464c76d713c07ad	0	2023-05-25 10:55:48	haupham12345	2023-05-18 09:16:21.575278	haupham
38	haupham12345	4	39	25d55ad283aa400af464c76d713c07ad	0	2023-05-18 10:08:38.209587	haupham	2023-05-18 10:08:38.209587	haupham
36	haupham1236	2	37	25d55ad283aa400af464c76d713c07ad	0	2023-05-18 09:16:27.313192	haupham	2023-05-18 09:16:27.313192	haupham
2	haupham123	1	3	25d55ad283aa400af464c76d713c07ad	0	2023-05-31 09:54:08	haupham12345	2023-05-17 10:42:12.182502	haupham
39	haupham12069583	1	42	d41d8cd98f00b204e9800998ecf8427e	0	2023-06-02 17:14:42.03272	haupham12345	2023-05-31 13:39:40.258073	haupham12345
12	haupham123056945	1	13	25d55ad283aa400af464c76d713c07ad	0	2023-05-31 11:24:23	haupham12345	2023-05-18 09:15:17.481948	haupham
10	haupham12398854	1	11	25d55ad283aa400af464c76d713c07ad	1	2023-05-23 11:36:37	haupham12345	2023-05-18 09:15:12.129335	haupham
13	haupham123789	1	14	25d55ad283aa400af464c76d713c07ad	0	2023-05-24 14:56:41	haupham12345	2023-05-18 09:15:19.762619	haupham
37	haupham1234	1	38	25d55ad283aa400af464c76d713c07ad	0	2023-05-24 15:17:58	haupham12345	2023-05-18 10:08:33.021944	haupham
3	haupham1230213	1	4	25d55ad283aa400af464c76d713c07ad	0	2023-05-18 09:14:46.827784	haupham	2023-05-18 09:14:46.827784	haupham
\.


                                                    restore.sql                                                                                         0000600 0004000 0002000 00000031015 14437521121 0015364 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 15.2
-- Dumped by pg_dump version 15.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE "Study_Management";
--
-- Name: Study_Management; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "Study_Management" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';


ALTER DATABASE "Study_Management" OWNER TO postgres;

\connect "Study_Management"

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
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
-- Name: contract_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contract_type (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    short_name character varying(255),
    note text,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);


ALTER TABLE public.contract_type OWNER TO postgres;

--
-- Name: contract_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contract_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contract_type_id_seq OWNER TO postgres;

--
-- Name: contract_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contract_type_id_seq OWNED BY public.contract_type.id;


--
-- Name: departments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departments (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    short_name character varying(255),
    note text,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);


ALTER TABLE public.departments OWNER TO postgres;

--
-- Name: departments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.departments_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.departments_id_seq OWNER TO postgres;

--
-- Name: departments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.departments_id_seq OWNED BY public.departments.id;


--
-- Name: positions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.positions (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    short_name character varying(255),
    note text,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);


ALTER TABLE public.positions OWNER TO postgres;

--
-- Name: positions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.positions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.positions_id_seq OWNER TO postgres;

--
-- Name: positions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.positions_id_seq OWNED BY public.positions.id;


--
-- Name: profiles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.profiles (
    id integer NOT NULL,
    employee_id character varying(15) NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    birthday timestamp without time zone,
    position_id integer NOT NULL,
    department_id integer NOT NULL,
    status smallint,
    address character varying(255),
    telephone character varying(20),
    mobile character varying(20),
    official_date date,
    probation_date date,
    gender smallint,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255),
    image character varying(255)
);


ALTER TABLE public.profiles OWNER TO postgres;

--
-- Name: profiles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.profiles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.profiles_id_seq OWNER TO postgres;

--
-- Name: profiles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.profiles_id_seq OWNED BY public.profiles.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    username character varying(30) NOT NULL,
    password character varying(255) NOT NULL,
    image bytea
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    login_id character varying(30) NOT NULL,
    contract_type_id integer,
    profile_id integer NOT NULL,
    password character varying(255) NOT NULL,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: contract_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract_type ALTER COLUMN id SET DEFAULT nextval('public.contract_type_id_seq'::regclass);


--
-- Name: departments id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departments ALTER COLUMN id SET DEFAULT nextval('public.departments_id_seq'::regclass);


--
-- Name: positions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.positions ALTER COLUMN id SET DEFAULT nextval('public.positions_id_seq'::regclass);


--
-- Name: profiles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profiles ALTER COLUMN id SET DEFAULT nextval('public.profiles_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: contract_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contract_type (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
\.
COPY public.contract_type (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM '$$PATH$$/3384.dat';

--
-- Data for Name: departments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.departments (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
\.
COPY public.departments (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM '$$PATH$$/3376.dat';

--
-- Data for Name: positions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.positions (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
\.
COPY public.positions (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM '$$PATH$$/3378.dat';

--
-- Data for Name: profiles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.profiles (id, employee_id, name, email, birthday, position_id, department_id, status, address, telephone, mobile, official_date, probation_date, gender, del_flag, updated_time, updated_user, created_time, created_user, image) FROM stdin;
\.
COPY public.profiles (id, employee_id, name, email, birthday, position_id, department_id, status, address, telephone, mobile, official_date, probation_date, gender, del_flag, updated_time, updated_user, created_time, created_user, image) FROM '$$PATH$$/3380.dat';

--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, username, password, image) FROM stdin;
\.
COPY public."user" (id, username, password, image) FROM '$$PATH$$/3374.dat';

--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, login_id, contract_type_id, profile_id, password, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
\.
COPY public.users (id, login_id, contract_type_id, profile_id, password, del_flag, updated_time, updated_user, created_time, created_user) FROM '$$PATH$$/3382.dat';

--
-- Name: contract_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contract_type_id_seq', 4, true);


--
-- Name: departments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.departments_id_seq', 4, true);


--
-- Name: positions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.positions_id_seq', 7, true);


--
-- Name: profiles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.profiles_id_seq', 42, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 39, true);


--
-- Name: contract_type contract_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract_type
    ADD CONSTRAINT contract_type_pkey PRIMARY KEY (id);


--
-- Name: departments departments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_pkey PRIMARY KEY (id);


--
-- Name: positions positions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.positions
    ADD CONSTRAINT positions_pkey PRIMARY KEY (id);


--
-- Name: profiles profiles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: profiles profiles_department_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_department_id_fkey FOREIGN KEY (department_id) REFERENCES public.departments(id);


--
-- Name: profiles profiles_position_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_position_id_fkey FOREIGN KEY (position_id) REFERENCES public.positions(id);


--
-- Name: users users_profile_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_profile_id_fkey FOREIGN KEY (profile_id) REFERENCES public.profiles(id);


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   