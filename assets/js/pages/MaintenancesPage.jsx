import React, {useEffect, useState} from "react";
import axios from "axios";
import Accordion from "react-bootstrap/Accordion";
import Card from "react-bootstrap/Card";
import Container from "react-bootstrap/Container";
import renderMarkup from "react-render-markup";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";




const MaintenancesPage = props => {

    const url = window.location.href;
    const modele = url.substring(url.lastIndexOf('/') + 1);




    const [maintenances, setMaintenances] = useState([]);

    useEffect(() => {


        axios.get('http://localhost:8000/api/maintenances?device=', {
            params: {
                device: modele
            }
        })
            .then(response => response.data['hydra:member'])
            .then(data => setMaintenances(data))
            .catch(error => console.log(error.response));
    },[]);

console.log(maintenances);





    return (
        <>

            <Container fluid className="text-center">
                <h1>Liste des entretiens à effectuer:</h1>
                {maintenances.map( maintenance =>
                    <Row className="my-2" key={maintenance.id}>
                        <Col xs={{span: 12, offset:0}} md={{span: 6, offset:3}}>
                            <Accordion>
                                <Card className="text-center">
                                    <Card.Header className="text-primary" style={{fontWeight: 'bold'}}>
                                        <Accordion.Toggle as={Card.Header} variant="link" eventKey={maintenance.id}>
                                            {maintenance.nameStep}
                                        </Accordion.Toggle>
                                    </Card.Header>
                                    <Accordion.Collapse eventKey={maintenance.id}>
                                        <Card.Body>
                                            <Card.Text>{renderMarkup(maintenance.explanation)}</Card.Text>
                                            {maintenance.imageName.length > 4 &&
                                            <Card.Img style={{objectFit: 'contain'}} src={"images/maintenances/" + maintenance.imageName}/>
                                            }
                                        </Card.Body>
                                    </Accordion.Collapse>
                                </Card>
                            </Accordion>
                        </Col>
                    </Row>
                )}

            </Container>
        </>
    );
};

export default MaintenancesPage;