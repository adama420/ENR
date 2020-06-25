import React, {useState} from 'react';
import axios from "axios";


const LoginPage = props => {
    const [credentials, setCredentials] = useState({
        username: "",
        password: ""
    });

    const handleChange = event => {
        const value = event.currentTarget.value;
        const name = event.currentTarget.name;

        setCredentials({...credentials, [name]: value});
    };

    const handleSubmit = async event => {
        event.preventDefault();

        try {
            const token = await axios
                .post("http://localhost:8000/api/login_check", credentials)
                .then(response => response.data.token);
            window.localStorage.setItem("authToken", token);

            axios.defaults.headers["Authorization"] = "Bearer " + token;
        } catch (error) {
            console.log(error.response);
        }

        console.log(credentials);
    };

    return (
       <>
            <h1>Connexion :</h1>
           <form onSubmit={handleSubmit}>
               <div className="form-group">
                   <label htmlFor="username">Adresse email</label>
                   <input value={credentials.username} onChange={handleChange} type="email" placeholder="adresse@mail.com" name="username" id="username" className="form-control"/>
               </div>
               <div className="form-group">
                   <label htmlFor="password">Mot de passe</label>
                   <input value={credentials.password} onChange={handleChange} type="password" placeholder="******" name="password" id="password" className="form-control"/>
               </div>
               <div className="form-group">
                   <button type="submit" className="btn btn-success">Connexion</button>
               </div>
           </form>
       </>
    );

};

export default LoginPage;