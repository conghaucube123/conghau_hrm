PGDMP         9                {            study_management    15.2    15.2 =    X           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            Y           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            Z           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            [           1262    16406    study_management    DATABASE     �   CREATE DATABASE study_management WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
     DROP DATABASE study_management;
                postgres    false            �            1259    16507    contract_type    TABLE     �  CREATE TABLE public.contract_type (
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
       public         heap    postgres    false            �            1259    16506    contract_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.contract_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.contract_type_id_seq;
       public          postgres    false    224            \           0    0    contract_type_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.contract_type_id_seq OWNED BY public.contract_type.id;
          public          postgres    false    223            �            1259    17230    course    TABLE       CREATE TABLE public.course (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    course_type character varying(255) NOT NULL,
    "time" time without time zone,
    weekdays character varying(255),
    start_date date,
    end_date date,
    note text,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);
    DROP TABLE public.course;
       public         heap    postgres    false            �            1259    17284    course_details    TABLE     �  CREATE TABLE public.course_details (
    id integer NOT NULL,
    course_id integer NOT NULL,
    profile_id integer NOT NULL,
    del_flag smallint DEFAULT 0,
    updated_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255)
);
 "   DROP TABLE public.course_details;
       public         heap    postgres    false            �            1259    17283    course_details_id_seq    SEQUENCE     �   CREATE SEQUENCE public.course_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.course_details_id_seq;
       public          postgres    false    228            ]           0    0    course_details_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.course_details_id_seq OWNED BY public.course_details.id;
          public          postgres    false    227            �            1259    17229    course_id_seq    SEQUENCE     �   CREATE SEQUENCE public.course_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.course_id_seq;
       public          postgres    false    226            ^           0    0    course_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.course_id_seq OWNED BY public.course.id;
          public          postgres    false    225            �            1259    16423    departments    TABLE     �  CREATE TABLE public.departments (
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
       public         heap    postgres    false            �            1259    16422    departments_id_seq    SEQUENCE     �   CREATE SEQUENCE public.departments_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.departments_id_seq;
       public          postgres    false    216            _           0    0    departments_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.departments_id_seq OWNED BY public.departments.id;
          public          postgres    false    215            �            1259    16433 	   positions    TABLE     �  CREATE TABLE public.positions (
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
       public         heap    postgres    false            �            1259    16432    positions_id_seq    SEQUENCE     �   CREATE SEQUENCE public.positions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.positions_id_seq;
       public          postgres    false    218            `           0    0    positions_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.positions_id_seq OWNED BY public.positions.id;
          public          postgres    false    217            �            1259    16443    profiles    TABLE       CREATE TABLE public.profiles (
    id integer NOT NULL,
    employee_id character varying(15) NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    birthday date,
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
       public         heap    postgres    false            �            1259    16442    profiles_id_seq    SEQUENCE     �   CREATE SEQUENCE public.profiles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.profiles_id_seq;
       public          postgres    false    220            a           0    0    profiles_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.profiles_id_seq OWNED BY public.profiles.id;
          public          postgres    false    219            �            1259    16407    user    TABLE     �   CREATE TABLE public."user" (
    id integer NOT NULL,
    username character varying(30) NOT NULL,
    password character varying(255) NOT NULL,
    image bytea
);
    DROP TABLE public."user";
       public         heap    postgres    false            �            1259    16483    users    TABLE       CREATE TABLE public.users (
    id integer NOT NULL,
    login_id character varying(30) NOT NULL,
    contract_type_id integer,
    profile_id integer NOT NULL,
    password character varying(255) NOT NULL,
    del_flag smallint DEFAULT 0,
    updated_time timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    updated_user character varying(255),
    created_time timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    created_user character varying(255),
    recent_login timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16482    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    222            b           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    221            �           2604    16510    contract_type id    DEFAULT     t   ALTER TABLE ONLY public.contract_type ALTER COLUMN id SET DEFAULT nextval('public.contract_type_id_seq'::regclass);
 ?   ALTER TABLE public.contract_type ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    224    223    224            �           2604    17233 	   course id    DEFAULT     f   ALTER TABLE ONLY public.course ALTER COLUMN id SET DEFAULT nextval('public.course_id_seq'::regclass);
 8   ALTER TABLE public.course ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    226    226            �           2604    17287    course_details id    DEFAULT     v   ALTER TABLE ONLY public.course_details ALTER COLUMN id SET DEFAULT nextval('public.course_details_id_seq'::regclass);
 @   ALTER TABLE public.course_details ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    228    227    228            �           2604    16426    departments id    DEFAULT     p   ALTER TABLE ONLY public.departments ALTER COLUMN id SET DEFAULT nextval('public.departments_id_seq'::regclass);
 =   ALTER TABLE public.departments ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            �           2604    16436    positions id    DEFAULT     l   ALTER TABLE ONLY public.positions ALTER COLUMN id SET DEFAULT nextval('public.positions_id_seq'::regclass);
 ;   ALTER TABLE public.positions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218            �           2604    16446    profiles id    DEFAULT     j   ALTER TABLE ONLY public.profiles ALTER COLUMN id SET DEFAULT nextval('public.profiles_id_seq'::regclass);
 :   ALTER TABLE public.profiles ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219    220            �           2604    16486    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    222    222            Q          0    16507    contract_type 
   TABLE DATA           �   COPY public.contract_type (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    224   O       S          0    17230    course 
   TABLE DATA           �   COPY public.course (id, name, course_type, "time", weekdays, start_date, end_date, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    226   �O       U          0    17284    course_details 
   TABLE DATA           �   COPY public.course_details (id, course_id, profile_id, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    228   qQ       I          0    16423    departments 
   TABLE DATA           �   COPY public.departments (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    216   �W       K          0    16433 	   positions 
   TABLE DATA           �   COPY public.positions (id, name, short_name, note, del_flag, updated_time, updated_user, created_time, created_user) FROM stdin;
    public          postgres    false    218   �X       M          0    16443    profiles 
   TABLE DATA           �   COPY public.profiles (id, employee_id, name, email, birthday, position_id, department_id, status, address, telephone, mobile, official_date, probation_date, gender, del_flag, updated_time, updated_user, created_time, created_user, image) FROM stdin;
    public          postgres    false    220   �Y       G          0    16407    user 
   TABLE DATA           ?   COPY public."user" (id, username, password, image) FROM stdin;
    public          postgres    false    214   �]       O          0    16483    users 
   TABLE DATA           �   COPY public.users (id, login_id, contract_type_id, profile_id, password, del_flag, updated_time, updated_user, created_time, created_user, recent_login) FROM stdin;
    public          postgres    false    222   ^       c           0    0    contract_type_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.contract_type_id_seq', 4, true);
          public          postgres    false    223            d           0    0    course_details_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.course_details_id_seq', 129, true);
          public          postgres    false    227            e           0    0    course_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.course_id_seq', 11, true);
          public          postgres    false    225            f           0    0    departments_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.departments_id_seq', 4, true);
          public          postgres    false    215            g           0    0    positions_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.positions_id_seq', 7, true);
          public          postgres    false    217            h           0    0    profiles_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.profiles_id_seq', 43, true);
          public          postgres    false    219            i           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 40, true);
          public          postgres    false    221            �           2606    16515     contract_type contract_type_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.contract_type
    ADD CONSTRAINT contract_type_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.contract_type DROP CONSTRAINT contract_type_pkey;
       public            postgres    false    224            �           2606    17292 "   course_details course_details_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.course_details
    ADD CONSTRAINT course_details_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.course_details DROP CONSTRAINT course_details_pkey;
       public            postgres    false    228            �           2606    17238    course course_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.course
    ADD CONSTRAINT course_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.course DROP CONSTRAINT course_pkey;
       public            postgres    false    226            �           2606    16431    departments departments_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.departments DROP CONSTRAINT departments_pkey;
       public            postgres    false    216            �           2606    16441    positions positions_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.positions
    ADD CONSTRAINT positions_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.positions DROP CONSTRAINT positions_pkey;
       public            postgres    false    218            �           2606    16451    profiles profiles_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.profiles DROP CONSTRAINT profiles_pkey;
       public            postgres    false    220            �           2606    16411    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public            postgres    false    214            �           2606    16491    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    222            �           2606    17293 ,   course_details course_details_coures_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.course_details
    ADD CONSTRAINT course_details_coures_id_fkey FOREIGN KEY (course_id) REFERENCES public.course(id);
 V   ALTER TABLE ONLY public.course_details DROP CONSTRAINT course_details_coures_id_fkey;
       public          postgres    false    226    228    3249            �           2606    17298 -   course_details course_details_profile_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.course_details
    ADD CONSTRAINT course_details_profile_id_fkey FOREIGN KEY (profile_id) REFERENCES public.profiles(id);
 W   ALTER TABLE ONLY public.course_details DROP CONSTRAINT course_details_profile_id_fkey;
       public          postgres    false    3243    228    220            �           2606    16457 $   profiles profiles_department_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_department_id_fkey FOREIGN KEY (department_id) REFERENCES public.departments(id);
 N   ALTER TABLE ONLY public.profiles DROP CONSTRAINT profiles_department_id_fkey;
       public          postgres    false    216    220    3239            �           2606    16452 "   profiles profiles_position_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_position_id_fkey FOREIGN KEY (position_id) REFERENCES public.positions(id);
 L   ALTER TABLE ONLY public.profiles DROP CONSTRAINT profiles_position_id_fkey;
       public          postgres    false    220    218    3241            �           2606    16492    users users_profile_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_profile_id_fkey FOREIGN KEY (profile_id) REFERENCES public.profiles(id);
 E   ALTER TABLE ONLY public.users DROP CONSTRAINT users_profile_id_fkey;
       public          postgres    false    222    3243    220            Q   �   x���=
�0��z�^�0�����YXn�AA�"z���e��+^ݹ,�0�#t KI�[P�U��ijb�0��;���������ʉs��-A�~�>ᘷ�^�V��XvU�Ot&A�W<�=�ɺʦ%WW?�[�o���tUO      S   �  x���MO�@�ϻ��w�����~�P$*q��q�b��J@#��w�8��$��k��g�j������P!%����E�KK�%�P��T�;��C6$!�0�����G���ٜ��GS߽�(`��E%���"&�F��1ӤVy����i3��4��@dr&~	�=a1��K8�9�u7��a/�����]�З�|�`��@E���ΟxY��'4��1Y1�}q/�9��Vggc3��t˼�}I�n�#�U~L(	F���bb6YD�!X��ۦ�z�Zen�^#>��	��~��dL��^��?��_�o����eE���v���U�`oB_�	�,�7��A�H���-�|�ykڗ���A0 �GB�.d�%!��01$_&X�cetP����w��g����H�F<Ű�j6CG�b(O����D����ӯ8�      U   g  x��Zˎ$9<_1?0��G}�^�6������A֩'1^���>���lL�L~�C�!U�g�?�~p{��OiSj�߿������Y���ő��E���X�[?��8R�Z�۴0���7�Q�y����������[/:E���G݉�������Zi��8N|O�h�K��q����=$��C�D�h9�e�1����8�������4>�8�
�a�[/8���@�]w&��R;�ydqĮ<a�l\ �&'�G��ӻ�<B���q��G��Ӱ2���g=1�8bWI�;3?+�ɵ���v8ʆ'�TT�l�p�Hh�4D�^5��G�P'�^�G�3�p�K�DXQ�Q�<�p$�́R�mf��r:1�8B�H�D���&?��p�tk0�|t빃�p$�EK�Ŗ�[Iq�
���`I��G2@xFi}�c&"�����ۨ|��Gr��>	 B*�i=UE�#u�qX*e��c%�8R�8"�[;;��/�21
�:�y�q��>KN'�ڄ��q���h�P�a�2�;�%��1��p=�<�p�Ӑ�� ������N#/j�2��y2v8Br4�"L�ޜr"q�A@#�0o�]��G��82��O������r��|2�ej+?���7�H���t���e������6j.�����aAô�ri�p�-���|*�4�~�F�#����ٸ�bP;�`��6�90:D`hE��B��-g��������P�pd��p;�V���{�-�̯"sF����i����|2����nV�+��G��0��Z�a������r��)���'c�#���/0�H��k{�#�S��Q��q�#������o�fM��G��90��$]�1�1�zu根^�A�=�\���g�>��u�֕3oq��K�.m����Gj�[u�I0�xD+�1\����Qw��̹��T�jj� u{�s+]f�Ĝ�����+b��f+c�������&��O>�G��mV|�`����!�Q_ s���ZR�	�F��5�4 �95iT	�P����W��s�dwR	��8sXs>j/�|��GC������@��̙�q�:��>��\';o'�l�'W��)�g��	�Fw�?{�+;��iIm$8�1nm��
�kf]��1㦓+ ]sbh͆�G�͸�T� ���IsMp4�6ɶ`�uXR�	�&;�Ō�וl�-[�M��5�W&m� �gc�#��7�W�����h6�FPs�dE�h�y�w8�.��N������y5�p��ϐ�W��yYv���hz1G��>��g�������&^�s����U���?��w·������-y6����gv�D��>�x���{J-��3{_����
�>�z�H�os��I��������Ǌ:���:���S��j����S��ԁ�?@�B�$���I#���j��]��<n��`v���mbv��x��uc4��|�����x�����M��
���6�����F�Io3_���ϼ�5ؗ=E�8��:���j������K���Q^�"0k3�L��\n����2c��8s����HoD�r}s�{K��@|���b����|+0y���+�_��1��R7W��U��?Q��      I   �   x����
�0���S�Jr&�f�k�!ԀF��篅n�n�����+�|x$�[h�&6�� 䘧\��L7�0Bf�(�@�2���`���1�F����?���HH�2�/�Y)��*k�=l�y��#�Q�Lk-��9�0	�#;�����W�c~b�!�1��Iu^�      K   �   x����j�0���S�j$[�S�J(��2|��d�CӒ%�?�0(�=:~�$������uZ���� 4j�C�#'	�a�Q!q�j�z����R�4C8��U��}ݺA��S���v�a��4N_pz�~C�ޢ'V��h�#����8/2���\`I��j��la!�)~��#���8�M�7N1�q�d�h���9O��Ė�(.#�A7��"��{��G��K+v�\̼��%��� ��      M   "  x��XKo#E>�E��x���Տ9Rdi��J{�x��Y�L�"\‐V��!'��=p!␐��B�������`{z<�=��k��@�&C�E'����X��������h�^������`0NG_���q���]	���q:M'�dx-�^M/.�ħ��8LE/�<��/������qt)zÑ8M��7����ʶI���
��O��T]��$��5] 6�&A'�r�vߕ��.X&!� �_ɗE�q:�`���9=EO�7�ٷq���D?���~�t��I��?�p�4VR{e�萱UЬ�|�����Uq�p>,)���y�]���S:v� u	n�%ϟt��=񅇷a7<+�������ء�N7��b��Ԫ����Zp~W[H[�u
.�	P�0U��n+(��N�w?�-�%���5�j�	@��	��ђv�f{��V���{�A�t)7�8&
hΎ7��u�g�Εퟶ����ê�@S��R��;���7�J�UK��9�1��Z���ˑ��������gU�/^�C�U̜z�3�V��u��2�r/�[m�O��:�o��%<���M͝ѓqܱJ�n�`P��+�������qX����5���3ţ��Ӂ#MEϴ�W7Z����Q�fc^]��9�t���_YW�X�����@�xK9ߌ[W�e\�L����j���R�W���hȺ���E���"N�L�����W;<�ߕ�Z'����	�M�Ip���:Ęȑ�2��8�������-��t4��k"�jD���lz����f@4T	n��}����~�3���|��~>��2�����Ǻ5��>�a�� ��n)�$g�D�7��́�k�+�K;Z>@�w �A��<,��P�.��)_iz{,	C��;c�S����_îJ��iN]��nx���4�Ñn�\0 ��&d�0`�O�)��ژϏ�_�]��5d=U����5�+�Ą<��ie3���\NZܘ�ɐE���vA�R�v	�Xy�\��7�p�1j�Fo6�����=�Xs      G   %   x�3��H,�442���2qa<c�Ƌ���� �A	�      O   �  x���Mn�@���)�/2��t�Z	�)�M�_���6�5�ԇ�����v������E�-�`,���y%��Y ίR�bu5��y]`! ~}&~Bn��ئ�g�DCm̥��P�QU�Q{�,�Z��fթnZlb��x���P�q<��g(.���b�����GX&�xԯ��S�}|�6�������U������e\������q��D���Յ��.;�S��i?-��Uݗк�RA'�	DAkdߌ	����L��@LЊ8�L�a���JG�y'rm|��]F
f=�8&� �٠�7�_?�d(��N$e2a7�<iR���ˍ�ܬڝ�h}�2��l����=�����b�*�Ġa��#�v�9���E�K��kid�s�8��ү&?�ݘ<-�5��e�{�ֆ^B�NȚweX���[] ̈́K����O�fЕa�7=��� ���E���(s����%32��ZjP�􎙕A�&D�H�ل���{����G���B<`M���3�؝X7�Ǯ���T,����gM+�*3��AWS�)��?��H��ͦ�dǜoB��1�R�ޘ�i��$��%���h�FV�{���n"��1�J]*�T�P�9�����z*�e��f@1�z}ПƖJ�4Z��}��$�"�&��2m~:����N�?�a     