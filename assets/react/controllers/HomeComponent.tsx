import React from 'react';

const HomeComponent: React.FC = () => {
    return (
        <div className="flex items-center space-x-4">
            <img
                src="/assets/images/szymon_siedzi_xd.png"
                alt="Szymon Siedzi"
                className="w-32 h-32 rounded-full"
            />
            <h1 className="text-3xl text-white">Szymon Lasek</h1>
        </div>
    );
};

export default HomeComponent;
