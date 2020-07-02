import React, {useEffect, useState} from "react";
import axios from "axios";



const NoticesPage = props => {

    const url = window.location.href;
    const modele = url.substring(url.lastIndexOf('/') + 1);


    const [notices, setNotices] = useState([]);
    useEffect(() => {


        axios.get('http://localhost:8000/api/notices?device=', {
            params: {
                device: modele
            }
        })
            .then(response => response.data['hydra:member'])
            .then(data => setNotices(data))
            .catch(error => console.log(error.response));
    },[]);

    console.log(notices);

    const handleTransfert = event => {
        const data = event.currentTarget.value;
        console.log(data);
    }

    return (
        <div className="container text-center">
            <div className="row align-items-center">

                    <img className="mb-5 mx-auto" style={{maxWidth: 80}}src="https://image.flaticon.com/icons/svg/2932/2932728.svg"/>

            </div>
            {notices.map( notice =>
            <button onClick={handleTransfert} value={notice.imageName}><a href={"http://127.0.0.1:8000/pdf/devices/"+ notice.imageName}>Voir</a></button>
            )}
        </div>

    );
};

export default NoticesPage;